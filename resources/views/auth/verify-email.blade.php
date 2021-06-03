@extends('layouts.app')

@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">Vérification de votre email</h2>
                <p>Merci de vous être inscrit&nbsp;! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en
                    cliquant sur le lien que nous vous avons envoyé par e-mail&nbsp;?</p>
                    <div class="container-form-email notVisible">
                        <label for="email"
                        >Email</label>
                        <input id="email" type="email" class="email-label @error('email') is-invalid @enderror"
                               name="email" value="{{ request()->get('email') ?? old('email') }}" required
                               aria-required="true" autocomplete="email" autofocus>

                        @error('email')
                        <div class="container-error">
                            <span role="alert" class="error">
                                <strong>{{ ucfirst($message) }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>

                    <div>
                        <form aria-label="Vérification d'email" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="button-cta" type="submit">
                                {{ __('Renvoyer l\'e-mail de vérification') }}
                            </button>
                        </form>
                    </div>
                    <div>

                        <form aria-label="Déconnexion" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="button-cta">
                                {{ __('Déconnexion') }}
                            </button>
                        </form>
                    </div>
            </div>

            <div class="container-svg">
                <img width="300" height="300" class="svg-icon" src="{{asset('svg/New Message_Monochromatic.svg')}}"
                     alt="Icone d'un ordinateur avec un mot de passe crypter">
            </div>
        </section>
    </div>
    @if (session('status') == 'verification-link-sent')
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="cross icone">
            <p>Un nouveau lien de vérification a été envoyé à l'adresse électronique que vous avez fournie lors de votre inscription.</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
@endsection
