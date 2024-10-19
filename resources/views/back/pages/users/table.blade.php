    @foreach ($users as $index => $user)
    <tr>
        <td>
            <div class="form-check style-check d-flex align-items-center">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label">{{ $index + 1 }}</label>
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <img src="{{ asset($user->profile->avatar ?? 'path/to/default/avatar.jpg') }}"
                    alt="Avatar de {{ $user->firstname }}" class="flex-shrink-0 me-12 radius-8"
                    style="width: 40px; height: 40px; object-fit: cover;">
                <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $user->firstname }} {{ $user->lastname }}</h6>
            </div>
        </td>
        <td>{{ $user->phone }}</td>
        <td>
            @if ($user->getRoleNames()->isNotEmpty())
            @foreach ($user->getRoleNames() as $role)
            <span class="badge bg-primary">{{ \Spatie\Permission\Models\Role::where('name', $role)->first()->role
                }}</span>{{ !$loop->last ? ', ' : '' }}
            @endforeach
            @else
            N/A
            @endif
        </td>
        <td>
            <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                {{ $user->status ? 'Actif' : 'Inactif' }}
            </span>
        </td>
        <td>
            {{ $user->created_at ?
            ucfirst(\Carbon\Carbon::parse($user->created_at)->locale('fr_FR')->translatedFormat('D d M Y')) : 'N/A' }}
        </td>
        <td class="text-center">
            <div class="d-flex align-items-center gap-10 justify-content-center">
                <a href="{{ route('users.show', $user) }}"
                    class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                    <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                </a>
                <a href="{{ route('users.delete', $user) }}"
                    class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{ $user->firstname }} {{ $user->lastname }} ?');">
                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                </a>
                <!-- Bouton Activer/Désactiver -->
                @if($user->status)
                <a href="{{ route('users.updateStatus', $user) }}"
                    class="bg-info-focus bg-hover-info-200 text-dark-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                    onclick="return confirm('Êtes-vous sûr de vouloir désactiver {{ $user->firstname }} {{ $user->lastname }} ?');">
                    <iconify-icon icon="mdi:account-off-outline" class="menu-icon"></iconify-icon>
                </a>
                @else
                <a href="{{ route('users.updateStatus', $user) }}"
                    class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                    onclick="return confirm('Êtes-vous sûr de vouloir activer {{ $user->firstname }} {{ $user->lastname }} ?');">
                    <iconify-icon icon="mdi:account-check-outline" class="menu-icon"></iconify-icon>
                </a>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
