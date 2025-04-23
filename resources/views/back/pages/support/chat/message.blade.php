@extends('back.layouts.master')
@section('title', 'Support de Chat')
@section('customCSS')
    <style>
        .active-conversation {
            background-color: #e4f1ff;
        }
    </style>
@endsection

@section('content')
<div class="chat-wrapper">
    <div class="chat-sidebar card">
        <div class="chat-sidebar-single active top-profile">
            <div class="img">
                <img src="{{ asset(Auth::user()->profile->avatar) }}" alt="image">
            </div>
            <div class="info">
                <h6 class="text-md mb-0">{{ Auth::user()->lastname.' '.Auth::user()->firstname }}</h6>
                <p class="mb-0">
                    @if (Auth::user()->getRoleNames()->isNotEmpty())
                        @foreach (Auth::user()->getRoleNames() as $role)
                            <span>{{ \Spatie\Permission\Models\Role::where('name', $role)->first()->role }}</span>{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    @else
                        N/A
                    @endif
                </p>
            </div>
            <div class="action">
                <div class="btn-group">
                    <button type="button" class="text-secondary-light text-xl" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <iconify-icon icon="bi:three-dots"></iconify-icon>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end border">
                        <li>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-2">
                                <iconify-icon icon="fluent:person-32-regular"></iconify-icon>
                                Mon Profil
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- chat-sidebar-single fin -->
        <div class="chat-search">
            <span class="icon">
                <iconify-icon icon="iconoir:search"></iconify-icon>
            </span>
            <input type="text" name="#0" autocomplete="off" placeholder="Rechercher...">
        </div>
        <div class="chat-all-list">

        </div>
    </div>
    <div class="chat-main card">
        <div class="chat-sidebar-single active" id="chatHeader">

        </div><!-- chat-sidebar-single fin -->
        <div class="chat-message-list">

        </div>
        <form id="chatMessageForm" class="chat-message-box">
            @csrf
            <input type="text" name="content" placeholder="Écrire un message" required>

            <input type="file" name="file" accept="image/*" style="display: none;">

            <div class="chat-message-box-action">
                <button type="button" class="text-xl" id="fileButton">
                    <iconify-icon icon="solar:gallery-linear"></iconify-icon>
                </button>
                <button type="submit" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                    Envoyer
                    <iconify-icon icon="f7:paperplane"></iconify-icon>
                </button>
            </div>
        </form>
    </div>
</div>
<audio id="notification-sound" src="{{ asset('storage/back/assets/images/chat/songs/receive.mp3') }}" preload="auto"></audio>
<audio id="send-sound" src="{{ asset('storage/back/assets/images/chat/songs/send.mp3') }}" preload="auto"></audio>
@endsection

@section('customJS')
<script>
    $(document).ready(function() {

        // Fonction pour récupérer les messages
        function fetchMessages() {
            $.ajax({
                url: '/chat/messages/conversations', // Votre route
                method: 'GET',
                success: function(data) {
                    $('.chat-all-list').empty(); // Vider la liste avant d'ajouter les nouveaux messages

                    // Objet pour stocker le nombre de non lus
                    const newUnreadCounts = {};

                    data.forEach(function(conversation) {
                        const messageDate = new Date(conversation.createdAt);
                        const now = new Date();

                        let formattedDate;
                        if (messageDate.toDateString() === now.toDateString()) {
                            formattedDate = 'Aujourd\'hui';
                        } else if (messageDate.toDateString() === new Date(now.setDate(now.getDate() - 1)).toDateString()) {
                            formattedDate = 'Hier';
                        } else {
                            formattedDate = messageDate.toLocaleDateString('fr-FR', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                            });
                        }

                        $('.chat-all-list').append(`
                            <div class="chat-sidebar-single"
                                data-conversation-id="${conversation.id}">
                                <div class="img">
                                    <img src="${conversation.image}" alt="image">
                                </div>
                                <div class="info">
                                    <h6 class="text-sm mb-1">${conversation.firstname} ${conversation.lastname}</h6>
                                    <span style="font-size: ${conversation.lastMessage ? '12px !important' : 'inherit'};">
                                        ${conversation.lastMessage ? conversation.lastMessage : '<iconify-icon icon="solar:gallery-linear"></iconify-icon>'}
                                    </span>
                                </div>
                                <div class="action text-end">
                                    <p class="mb-0 text-neutral-400 text-xs lh-1">${formattedDate} à ${conversation.time}</p>
                                    ${conversation.unreadCount !== 0 ? `<span class="w-16-px h-16-px text-xs rounded-circle bg-warning-main text-white d-inline-flex align-items-center justify-content-center">${conversation.unreadCount}</span>` : ''}
                                </div>
                            </div><!-- chat-sidebar-single fin -->
                        `);

                        // Stocker le nombre de non-lus pour cette conversation
                        newUnreadCounts[conversation.id] = conversation.unreadCount;
                    });

                    // Récupérer l'ID de la conversation active
                    const activeConversationId = localStorage.getItem('activeConversationId');
                    if (activeConversationId) {
                        // Appliquer la classe active à la conversation sélectionnée
                        $(`.chat-sidebar-single[data-conversation-id="${activeConversationId}"]`).addClass('active-conversation');

                        // Charger les messages de la conversation active
                        loadMessages(activeConversationId);
                        loadUserInfo(activeConversationId);
                    }

                    // Gestion des messages non lus
                    if (activeConversationId) {
                        // Obtenir le nombre de non lus de la session
                        const oldCount = sessionStorage.getItem(`unreadCount_${activeConversationId}`) || 0;
                        const newCount = newUnreadCounts[activeConversationId] || 0;

                        // Émettre un son si le nombre a augmenté
                        if (parseInt(newCount) > parseInt(oldCount)) {
                            document.getElementById('notification-sound').play().catch(e => console.error("Erreur lors de la lecture du son:", e));
                        }

                        // Mettre à jour la session avec le nouveau nombre de non lus
                        sessionStorage.setItem(`unreadCount_${activeConversationId}`, newCount);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors de la récupération des messages :', error);
                }
            });
        }

        // Écouteur d'événements pour le clic sur une conversation
        $('.chat-all-list').on('click', '.chat-sidebar-single', function() {
            const conversationId = $(this).data('conversation-id');
            localStorage.setItem('activeConversationId', conversationId); // Sauvegarder l'ID de la conversation dans localStorage

            // Retirer la classe active de toutes les conversations et l'ajouter à celle cliquée
            $('.chat-sidebar-single').removeClass('active-conversation');
            $(this).addClass('active-conversation');

            // Appeler la fonction pour marquer les messages comme lus
            $.ajax({
                url: `/chat/messages/read/${conversationId}`, // Votre nouvelle route
                method: 'GET',
                success: function(response) {
                    // Charger les informations de l'utilisateur et les messages de la conversation
                    loadUserInfo(conversationId);
                    loadMessages(conversationId);

                    // Mettre à jour le nombre de non lus dans la session après marquage
                    sessionStorage.setItem(`unreadCount_${conversationId}`, 0); // Réinitialiser le compteur
                },
                error: function(xhr, status, error) {
                    console.error('Erreur lors de la mise à jour des messages :', error);
                }
            });
        });

        $('.chat-message-list').on('click', '.delete-message-btn', function() {
            const messageId = $(this).data('message-id');

            $.ajax({
                url: `/chat/messages/${messageId}/delete`,
                method: 'GET',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(response) {
                    loadMessages(conversationId); // Recharger les messages après suppression
                },
                error: function(xhr) {
                    alert('Erreur lors de la suppression du message.');
                }
            });
        });

        $('.edit-message-btn').on('click', function() {
            const messageId = $(this).data('message-id');
            const messageText = $(this).closest('.chat-single-message').find('p.mb-3').text();

            // Exemple d'un champ de texte pour modifier le message
            $('#editMessageModal').find('#messageText').val(messageText); // Remplit un champ de texte avec le contenu actuel

            $('#editMessageModal').modal('show'); // Montre le modal pour modifier le message

            $('#saveChangesButton').off('click').on('click', function() {
                const newText = $('#editMessageModal').find('#messageText').val();

                $.ajax({
                    url: `/chat/messages/${messageId}update/`,
                    method: 'PUT', // Assure-toi que la méthode correspond à ce que tu as configuré côté serveur
                    data: {
                        text: newText, // Envoie le nouveau texte
                    },
                    success: function(response) {
                        fetchMessages();
                    },
                    error: function(xhr, status, error) {
                        console.error('Erreur lors de la mise à jour du message:', error);
                    }
                });
            });
        });


        // Appeler la fonction pour charger les messages lors du chargement de la page
        fetchMessages();

        // Mettre à jour les messages toutes les 3 secondes
        setInterval(fetchMessages, 3000);
    });


    function loadMessages(conversationId) {
        // Exemple d'appel AJAX pour récupérer les messages de la conversation
        $.ajax({
            url: `/api/conversations/${conversationId}/messages`, // Changez l'URL selon votre API
            method: 'GET',
            success: function(data) {
                // Vider la liste des messages précédents
                $('.chat-message-list').empty();

                // Parcourir les messages et les afficher
                data.forEach(function(message) {
                    const messageDate = new Date(message.createdAt);
                    const formattedTime = messageDate.toLocaleTimeString('fr-FR', {
                        hour: '2-digit',
                        minute: '2-digit',
                    });

                    $('.chat-message-list').append(`
                        <div class="chat-single-message ${message.isSender}">
                            ${message.isSender === 'left' ? `<img src="${message.image}" alt="image" class="avatar-lg object-fit-cover rounded-circle">` : ''}
                            <div class="chat-message-content">
                                ${
                                    message.isSender === 'right'
                                    ? `
                                        <div class="dropdown">
                                            <button class="btn px-18 py-11 text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <iconify-icon icon="ph:dots-three-outline-fill" class="menu-icon"></iconify-icon>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item delete-message-btn" data-message-id="${message.id}" href="javascript:void(0)">Supprimer</a></li>
                                            </ul>
                                        </div>
                                    `
                                    : ''
                                }
                                <div class="message-text" id="message-${message.id}">
                                    ${
                                        message.text
                                        ? `<p class="mb-3" data-text="${message.text}">${message.text}</p>`
                                        : `<img src="${message.messageImage}" alt="image du message" class="message-image mb-3">`
                                    }
                                </div>
                                <p class="chat-time mb-0">
                                    <span>${formattedTime}</span>
                                </p>
                            </div>
                        </div><!-- chat-single-message fin -->
                    `);

                });
            },
            error: function(xhr) {
                console.error('Erreur lors du chargement des messages :', xhr);
                alert('Une erreur est survenue lors du chargement des messages. Veuillez réessayer.');
            }
        });
    }

    function loadUserInfo(conversationId) {
        $.ajax({
            url: `/conversations/${conversationId}/user-info`, // URL pour récupérer les informations de l’utilisateur
            method: 'GET',
            success: function(data) {
                // Créez le HTML avec les données de l’utilisateur
                let userInfoHtml = `
                    <div class="img">
                        <img src="${data.image}" alt="image">
                    </div>
                    <div class="info">
                        <h6 class="text-md mb-0">${data.firstname} ${data.lastname}</h6>
                        <p class="mb-0">${data.role}</p>
                    </div>
                    <div class="action d-inline-flex align-items-center gap-3">
                `;

                // Ajouter le bouton de clôture si le statut de la conversation n'est pas 'resolved'
                if (data.statusConversation != 'resolved') {
                    userInfoHtml += `
                        <a href="/conversation/closed/${conversationId}" class="text-xl text-success" onclick="return closeConversation()">
                            <iconify-icon icon="mdi:shield-check-outline"></iconify-icon><!-- Icône pour clôturer -->
                        </a>
                    `;
                }

                // Cette condition sera gérée par votre code Laravel pour vérifier le rôle
                @if (Auth::user()->hasRole('super admin'))
                    userInfoHtml += `
                        <div class="btn-group">
                            <button type="button" class="text-primary-light text-xl" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                <iconify-icon icon="tabler:dots-vertical"></iconify-icon>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end border">
                                <li>
                                    <a class="dropdown-item" href="#">Bloquer</a>
                                </li>
                            </ul>
                        </div>
                    `;
                @endif

                userInfoHtml += `</div>`; // Fin de la div .action

                // Insérer l'HTML dans l'élément #chatHeader
                $('#chatHeader').html(userInfoHtml);
            },
            error: function(xhr) {
                console.error('Erreur lors de la récupération des informations de l’utilisateur :', xhr);
            }
        });
    }


    // Soumettre le formulaire de message
    $('#chatMessageForm').on('submit', function(e) {
        e.preventDefault(); // Empêche le rechargement de la page

        // Récupérer l'ID de conversation
        const conversationId = localStorage.getItem('activeConversationId');

        if (!conversationId) {
            alert('Aucune conversation active sélectionnée.');
            return;
        }

        // Préparer les données du formulaire
        const formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}'); // Ajoutez le token CSRF si nécessaire

        $.ajax({
            url: `/chat/send/${conversationId}`, // URL avec backticks pour inclure conversationId
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Réinitialiser le formulaire après l'envoi
                $('#chatMessageForm')[0].reset();
                loadMessages(conversationId); // Recharger les messages de la conversation active
                document.getElementById('send-sound').play().catch(e => console.error("Erreur lors de la lecture du son:", e));
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON?.message || xhr.responseText || 'Une erreur est survenue';
                console.error('Erreur lors de l\'envoi du message :', errorMessage);
                alert('Erreur : ' + errorMessage);
            }
        });
    });


    $('#fileButton').on('click', function() {
        $('input[name="file"]').click(); // Ouvrir le sélecteur de fichiers
    });

    $('input[name="file"]').on('change', function() {
        if (this.files.length > 0) {
            $('input[name="chatMessage"]').val(''); // Réinitialiser le champ de message
            $('#chatMessageForm').submit(); // Soumettre le formulaire
        }
    });
</script>
@endsection
