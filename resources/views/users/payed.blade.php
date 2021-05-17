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
                    <div class="container-all-announcement show-content container-create-ads-infos container-plans">
                        @foreach($plan as $p)
                            <section
                                class="container-plan container-payed-plan @if($p->id === 2) container-hot-plan @endif">
                                <div class="container-plan-price">
                                    <h4 aria-level="4">
                                        {{ucfirst($p->name)}}
                                    </h4>
                                    <span class="planPrice">
                             {{number_format((float)$p->price, 2, ',', '')}} €
                        </span>
                                    @if($p->oldprice)
                                        <p class="reductionPrice">
                                            {{$p->oldprice}} €
                                        </p>
                                    @endif
                                </div>
                                <ul>
                                    <li>
                                        <img src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée
                                        : {{$p->duration}} mois
                                    </li>
                                    <li>
                                        @if($p->priority) <img src="{{asset('svg/good.svg')}}"
                                                               alt="Icone correct"> @else <img
                                            src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Support
                                        prioritaire
                                    </li>
                                    <li>
                                        @if($p->more_visible)
                                            <img src="{{asset('svg/good.svg')}}"
                                                 alt="Icone correct">                                                    @else
                                            <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">
                                        @endif
                                        @if($p->id == 1)
                                            Forte visibilité
                                        @endif
                                        @if($p->id == 2)
                                            Votre annonce sera visible {{$p->id * 3}} fois plus souvent
                                        @endif
                                        @if($p->id == 3)
                                            Votre annonce sera visible {{$p->id * 5}} fois plus souvent
                                        @endif
                                    </li>
                                    <li>
                                        @if($p->hight_visibility) <img src="{{asset('svg/good.svg')}}"
                                                                       alt="Icone correct"> @else <img
                                            src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Grande
                                        visibilité
                                    </li>
                                </ul>
                            </section>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="container-price-paied">
                <div>
                    <h3 aria-level="3">Le montant s'éleve à
                        {{number_format((float)$p->price, 2, ',', '')}} € </h3>
                    <p>Saisissez les informations relatives à votre carte de crédit</p>
                    <form class="form-login form-register" enctype="multipart/form-data"
                          aria-label="Enregistrement d'un compte" role="form" method="POST"
                          action="{{ route('users.paied') }}">
                        @csrf
                        <div class="container-form-email">
                            <label class="hidden" for="payed-info"
                            >Informations de paiement</label>
                            <input id="payed" type="text"
                                   class="@error('payed-info') is-invalid @enderror email-label"
                                   name="payed" value="{{ old('payed') }}" required aria-required="true"
                                   autocomplete="payed-info"
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
                            <input id="role_id" name="role_id" type="hidden" value="2">
                            <input id="is_payed" name="is_payed" type="hidden" value="1">
                            <button role="button" class="button-cta" type="submit">
                                Finaliser mon achat
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
@endsection
