@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">Mot de passe oublié ?</h2>
                <p>Ce n'est qu'un oubli, pas de panique !</p>
                <form aria-label="Mot de passe oublié" class="form-login" role="form" method="POST"
                      action="{{ route('password.email') }}">
                    @csrf
                    <div class="container-form-email">
                        <label for="email"
                        >Adresse email</label>
                        <input id="email" type="email"
                               class="email-label @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email"
                               autofocus>
                        @error('email')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                    <div>
                        <div class="inscription-links">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}">
                                    Je me connecte
                                </a>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    S'inscrire
                                </a>
                            @endif
                        </div>
                        <button role="button" type="submit"
                                class="button-cta">
                            Je récupére mon mot de passe
                        </button>
                    </div>
                </form>
            </div>
            <div class="container-svg">
                <img class="svg-icon" src="{{asset('svg/Password_Monochromatic.svg')}}"
                     alt="Icone d'un ordinateur avec un mot de passe crypter">
            </div>
        </section>
    </div>
@endsection
