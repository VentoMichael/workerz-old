@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div class="container-about-text">
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Une demande ?
                    </h2>
                    <p>
                        Pour la moindre question ou une simple demande, n'hésitez pas à nous contacter
                    </p>
                </div>
                <div>
                    <a href="{{ route('register') }}">
                        <button role="button" class="button-cta" type="submit">
                            Je m'inscris
                        </button>
                    </a>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/us.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin container-message">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                Formulaire de contact
            </h2>
            <p>Il n'y a pas de mauvaises questions, la réponse sera presque imminente !</p>
        </div>
        <div>
            <form class="form-login form-register form-message" enctype="multipart/form-data"
                  aria-label="Enregistrement d'un compte" role="form" method="POST"
                  action="{{ route('register') }}">
                @csrf
                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="name">Nom <span class="required">*</span></label>
                        <input type="text" id="name" value="{{old("name")}}"
                               class=" @error('name') is-invalid @enderror email-label" name="name" required>
                    </div>
                    <div class="container-form-email">
                        <label for="surname">Prénom</label>
                        <input type="text" id="surname" value="{{old("surname")}}"
                               class=" @error('surname') is-invalid @enderror email-label" name="surname">
                    </div>
                </div>

                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="email">Email <span class="required">*</span></label>
                        <input id="email" type="email"
                               class=" @error('email') is-invalid @enderror email-label"
                               name="email"
                               value="{{ old('email') }}" placeholder="danielrotis@gmail.com" required autocomplete="email">
                        @error('email')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="subject">Sujet <span class="required">*</span></label>
                        <input type="text" placeholder="Engagez un menuisier" id="subject" value="{{old("subject")}}"
                               class=" @error('subject') is-invalid @enderror email-label" name="subject" required>
                    </div>
                </div>

                <div class="container-register-form container-textarea">
                    <div class="container-form-email">
                        <label for="message">Message <span class="required">*</span></label>
                        <textarea id="message" name="message" required
                                  class=" @error('message') is-invalid @enderror email-label"
                                  placeholder="Message eventuel..."
                                  rows="5" cols="33">{{old("message")}}</textarea>
                    </div>
                </div>

                <div>
                    <button role="button" class="button-cta" type="submit">
                        Envoyer un message
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
