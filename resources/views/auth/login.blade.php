@extends('layouts.app')

@section('content')
    @if(Session::has('messageBanned'))
        <div id="sucessMessage">{{ Session::get('messageBanned') }}</div>
    @endif
    <div class="container-home">
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
                               class="@error('email') is-invalid @enderror email-label"
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

                        <label for="password"
                        >Mot de passe</label>
                        <div class="@error('password')is-invalid @enderror password">

                            <input type="checkbox" class="password--visibleToggle" id="checkPass" checked>
                            <div class="password--visibleToggle-eye open">
                                <img src="{{asset('svg/eye-open.svg')}}" alt="icone de yeux ouvert"/>
                            </div>
                            <div class="password--visibleToggle-eye close">
                                <img src="{{asset('svg/eye-close.svg')}}" alt="icone de yeux fermé"/>
                            </div>

                            <input id="password" type="password"
                                   class="password--input"
                                   name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="container-error">
                                    <span role="alert" class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
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
            <div class="container-svg">
                <img class="svg-icon" src="{{asset('svg/Innovation _Monochromatic.svg')}}"
                     alt="icone d'ampoule">
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/passwordSee.js')}}"></script>
@endsection
