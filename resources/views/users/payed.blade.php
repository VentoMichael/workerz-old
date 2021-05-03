@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Finalisons l'achat ensemble
                    </h2>
                    <p>
                        Votre inscription sera valable après ce passage
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Card Payment_Monochromatic.svg')}}"
                     alt="icone de carte">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads">
        <div class="title-first-step-register">
            <h2 aria-level="2" class="hidden">Plan sélectionné pour votre inscription</h2>
        </div>
        <div class="container-home container-home_image">
            <section>
                <div class="container-connexion">
                    <h3 aria-level="3">Plan sélectionné</h3>
                    <div class="container-svg">
                        <img class="svg-icon" src="{{asset('svg/Innovation _Monochromatic.svg')}}"
                             alt="icone d'ampoule">
                    </div>
                </div>
            </section>
            <section>
                <div>
                    <h3 aria-level="3">Le montant s'éleve à 4,99€</h3>
                    <p>Saisissez les informations relatives à votre carte de crédit</p>
                    <form class="form-login" aria-label="Connexion" role="form" method="POST"
                          action="{{ route('login') }}">
                        @csrf
                        <div class="container-form-email">
                            <label class="hidden" for="payed-info"
                            >Informations de paiement</label>
                            <input id="payed-info" type="payed-info"
                                   class="@error('payed-info') is-invalid @enderror payed-info-label"
                                   name="payed-info" value="{{ old('payed-info') }}" required autocomplete="payed-info"
                                   autofocus>

                            @error('payed-info')
                            <div class="container-error">
                                    <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>

                        <div>
                            <button role="button" class="button-cta" type="submit">
                                Finaliser mon achat
                            </button>
                        </div>
                    </form>
            </section>
        </div>
    </section>
@endsection
