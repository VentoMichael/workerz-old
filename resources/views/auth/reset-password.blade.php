@extends('layouts.app')

@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">Réinitialisation de votre mot de passe</h2>
                <p>Ce n'est qu'un oubli, pas de panique&nbsp;!</p>
                <form aria-label="Modification du mot de passe" role="form" class="form-login" method="POST"
                      action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <div class="container-form-email notVisible">
                        <label for="email"
                        >Email</label>
                        <input id="email" type="email" class="email-label @error('email') is-invalid @enderror" name="email" value="{{ request()->get('email') ?? old('email') }}" required aria-required="true" autocomplete="email" autofocus>

                        @error('email')
                        <div class="container-error">
                            <span role="alert" class="error">
                                <strong>{{ ucfirst($message) }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="password"
                        >Mot de passe</label>
                        <input id="password" type="password"
                               class="email-label @error('password') is-invalid @enderror" name="password" required aria-required="true"
                               autocomplete="new-password">
                        <div id="container-checkpass" class="container-checkpass">
                            <input type="checkbox" class="password--visibleToggle password-toggle-reset" id="checkPass" checked>
                            <div class="password--visibleToggle-eye eye-forget-pass open">
                                <img width="40" height="60" src="{{asset('svg/eye-open.svg')}}" alt="icone de yeux ouvert"/>
                            </div>
                            <div class="password--visibleToggle-eye eye-forget-pass close">
                                <img width="40" height="60" src="{{asset('svg/eye-close.svg')}}" alt="icone de yeux fermé"/>
                            </div>
                        </div>
                        @error('password')

                        <div class="container-error">
                            <span role="alert" class="error">
                                <strong>{{ ucfirst($message) }}</strong>
                            </span>
                        </div>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="password-confirm">Confirmer le mot de passe</label>

                            <input id="password-confirm" type="password" class="email-label" name="password_confirmation" required aria-required="true" autocomplete="new-password">
                    </div>
                    <ul role="list" class="list-password-required">
                        <li id="cara">
                            <img width="40" height="60" src="{{asset('../svg/good.svg')}}" alt="Icone d'un pictogramme v correct">
                            <p role="listitem">
                                <span>&bull;</span> 8 caractères
                            </p>
                        </li>
                        <li id="maj">
                            <img width="40" height="60" src="{{asset('../svg/good.svg')}}" alt="Icone d'un pictogramme v correct">
                            <p role="listitem">
                                <span>&bull;</span> 1 majuscule
                            </p>
                        </li>
                        <li id="symbole">
                            <img width="40" height="60" src="{{asset('../svg/good.svg')}}" alt="Icone d'un pictogramme v correct">
                            <p role="listitem">
                                <span>&bull;</span> 1 chiffre
                            </p>
                        </li>
                    </ul>

                    <div>
                        <button role="button" type="submit"
                                class="button-cta">
                            Réinitialiser le mot de passe
                        </button>
                    </div>
                </form>
            </div>

            <div class="container-svg">
                    <img width="300" height="300" class="svg-icon" src="{{asset('svg/Settings_Monochromatic.svg')}}"
                         alt="Icone d'un ordinateur avec un mot de passe crypter">
                </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
@endsection
