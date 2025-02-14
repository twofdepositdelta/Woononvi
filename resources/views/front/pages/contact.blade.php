@extends('front.layouts.master')
@section('title', 'Nous-contacter')
@section('content')


<div class="contact-area py-120">
    <div class="container">
        <div class="contact-content">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Merci !</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-map-location-dot"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Adresse du bureau</h5>
                            <p>{{ FrontHelper::getSettingAddress()->value }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-phone-volume"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Appelez-nous</h5>
                            <p>
                                <a href="tel:{{ str_replace(' ', '', FrontHelper::getSettingPhone()->value) }}">
                                {{ FrontHelper::getSettingPhone()->value }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-envelopes"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Envoyez-nous un email</h5>
                            <p>
                                <a href="mailto:{{ FrontHelper::getSettingEmail()->value }}">
                                    {{ FrontHelper::getSettingEmail()->value }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-alarm-clock"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Heures d'ouverture</h5>
                            <p>Lun - Dim (06h00 - 20h00)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="contact-img">
                        <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/contact/01.jpg')}}"
                            alt="Image de contact">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="contact-form">
                        <div class="contact-form-header">
                            <h2>Contactez-nous</h2>
                            <p>Voyagez en toute sérénité en partageant votre trajet avec des personnes de confiance.
                                Ensemble, rendons les déplacements plus conviviaux et abordables.</p>

                        </div>
                        <form method="post" action="{{route('contact.send')}}" id="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fullname" placeholder="Votre nom"
                                            value="{{ old('fullname') }}" required>
                                        @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Votre email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <div class="col-md-3">
                                    <label for="country_code"></label>
                                    <select class="form-control" name="country_code" id="country_code" required>
                                        @foreach (BackHelper::countries() as $countrie )

                                        <option value="{{ $countrie->id }}" {{ old('country_code') == $countrie->indicatif ? 'selected' : '' }}>
                                            {{ $countrie->name }} ({{ $countrie->indicatif }})
                                        </option>

                                        @endforeach
                                        <!-- Ajoute d'autres indicatifs ici -->
                                    </select>
                                    @error('country_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-9">
                                    <label for="phone"></label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Votre téléphone"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Sujet"
                                    value="{{ old('subject') }}" required>
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea name="message" cols="30" rows="5" class="form-control"
                                    placeholder="Votre message" required>{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="theme-btn">Envoyer
                                    le message <i class="far fa-paper-plane"></i></button>

                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-messege text-success"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9431.064547576658!2d2.418763645297927!3d6.358546139746893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x102354e509f894f7%3A0xc8fde921f89849f6!2sCotonou!5e0!3m2!1sfr!2sbj!4v1732118403386!5m2!1sfr!2sbj"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>

@endsection
