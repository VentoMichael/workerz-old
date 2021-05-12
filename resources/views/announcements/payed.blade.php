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
        <div class="container-home container-home_image container-paied">
            <section>
                <div class="container-connexion container-plan-paied">
                    <h3 aria-level="3">Plan sélectionné</h3>
                    <div class="container-all-announcement container-create-ads-infos container-plans show-content">
                            <section
                                class="container-plan container-payed-plan @if($planId->id == 2) container-hot-plan @endif">
                                <div class="container-plan-price">
                                    <h4 aria-level="4">
                                        {{ucfirst($planId->name)}}
                                    </h4>
                                    <span class="planPrice">
                             {{number_format((float)$planId->price, 2, ',', '')}} €
                        </span>
                                    @if($planId->oldprice)
                                        <p class="reductionPrice">
                                            {{$planId->oldprice}} €
                                        </p>
                                    @endif
                                </div>
                                <ul>
                                    <li>
                                        <img src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée
                                        : {{$planId->duration}} mois
                                    </li>
                                    <li>
                                        @if($planId->priority) <img src="{{asset('svg/good.svg')}}"
                                                               alt="Icone correct"> @else <img
                                            src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Support
                                        prioritaire
                                    </li>
                                    <li>
                                        @if($planId->more_visible)
                                            <img src="{{asset('svg/good.svg')}}" alt="Icone correct">                                                    @else
                                            <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">
                                        @endif
                                        @if($planId->id == 1)
                                            Forte visibilité
                                        @endif
                                        @if($planId->id == 2)
                                            Votre annonce sera visible {{$planId->id * 3}} fois plus souvent
                                        @endif
                                        @if($planId->id == 3)
                                            Votre annonce sera visible {{$planId->id * 5}} fois plus souvent
                                        @endif
                                    </li>
                                    <li>
                                        @if($planId->hight_visibility) <img src="{{asset('svg/good.svg')}}"
                                                                       alt="Icone correct"> @else <img
                                            src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Grande
                                        visibilité
                                    </li>
                                </ul>
                            </section>
                    </div>
                </div>
            </section>
            <section class="container-price-paied">
                <div>
                    <h3 aria-level="3">Le montant s'éleve à
                        {{number_format((float)$planId->price, 2, ',', '')}} € </h3>
                    <p>Saisissez les informations relatives à votre carte de crédit</p>
                    <form class="form-login form-register show-content" enctype="multipart/form-data"
                          aria-label="Enregistrement d'un compte" role="form" method="POST"
                          action="{{ route('announcements.store') }}">
                        @csrf
                        <div class="container-form-email">
                            <label class="hidden" for="payed-info"
                            >Informations de paiement</label>
                            <input id="payed" type="text"
                                   class="@error('payed-info') is-invalid @enderror email-label"
                                   name="payed" value="{{ old('payed') }}" required autocomplete="payed-info"
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
                            <input type="hidden" name="plan" value="{{$planId}}">
                            <button role="button" name="is_payed" class="button-cta" type="submit">
                                Finaliser mon achat
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </section>
@endsection
