@extends('layouts.app')

@section('content')
    @if(Session::has('messageBanned'))
        <div id="sucessMessage"
             class="fixed top-0 bg-red-500 w-full p-4 right-0 text-center text-white">{{ Session::get('messageBanned') }}</div>
    @endif
    <section class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">Connexion</h2>
                <p>Revenez voir les nouveautés !</p>
                <form class="form-login" aria-label="Connexion" role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="container-form-email">
                        <label for="email"
                        >Adresse email</label>
                            <input id="email" type="email"
                                   class="email-label @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   autofocus>
                            @error('email')
                            <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    <div>

                        <label for="password"
                        >Mot de passe</label>
                        <div class="password">

                            <input type="checkbox" class="password--visibleToggle" checked>
                            <div class="password--visibleToggle-eye open">
                                <img src="{{asset('svg/eye-open.svg')}}"/>
                            </div>
                            <div class="password--visibleToggle-eye close">
                                <img src="{{asset('svg/eye-close.svg')}}"/>
                            </div>

                            <input id="password" type="text"
                                   class="password--input @error('password')is-invalid @enderror"
                                   name="password" required autocomplete="current-password">
                            @error('password')
                            <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <div>
                        <div class="inscription-links">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    S'inscrire
                                </a>
                            @endif
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                        <div>
                            <button role="button" class="button-cta" type="submit">
                                Je me connecte
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div>
                <img class="svg-icon" src="{{asset('svg/Innovation_Monochromatic.svg')}}"
                     alt="icone d'ampoule">
            </div>
        </section>
    </section>
@endsection
