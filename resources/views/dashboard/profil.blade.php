@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('expire'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/caution.svg')}}" alt="good icone">
            <p>{{Session::get('expire')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update-not'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}" alt="good icone">
            <p>{{Session::get('success-update-not')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('success-update')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('success-inscription')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-profil container-profils-infos">
            <h2 aria-level="2">
                Profil
            </h2>
            <div class="container-profil-dashboard">
                @if(auth()->user()->end_plan == null)
                    <div class="container-button-expire">
                        <a href="{{route('usersAlready.plans')}}" class="button-cta button-expire">
                            Je choisis mon plan
                        </a>
                    </div>
                @endif
                @if(auth()->user()->role_id == 2)
                    <div @if(auth()->user()->end_plan == null) class="expire-plan" @endif>
                        <section class="container-infos-dashboard">
                            <h3 aria-level="3">
                                Informations personnelles
                            </h3>
                            <div class="form-login form-edit-company form-register form-edit-preview">

                                <div class="container-register-form container-register">

                                    <div class="container-form-email">
                                        <div class="avatar-container">
                                            <div class="container-form-email avatar-profil avatar-dashboard">
                                                <div class="avatar-container">
                                                    <p>Logo</p>
                                                </div>
                                                @if(auth()->user()->picture != null)
                                                    <img src="{{asset(auth()->user()->picture)}}"
                                                         alt="logo de {{auth()->user()->name}}">
                                                @else
                                                    <img src="{{asset('svg/user.svg')}}"
                                                         alt="image de profil par défaut">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @if(auth()->user()->end_plan != null)
                                    <div class="container-form-email">
                                        <p>Plan : {{$plan->name}}</p>
                                        <span
                                            class="email-label">Date d'expiration le {{auth()->user()->end_plan->locale('fr')->isoFormat('Do MMMM YYYY, H:mm')}}</span>
                                    </div>
                                @else
                                    <div class="container-form-email">
                                        <p>Plan</p>
                                        <span class="email-label required">EXPIRER</span>
                                    </div>
                                @endif
                                @if(auth()->user()->catchPhrase)
                                    <div class="container-form-email">
                                        <p>Phrase d'accroche</p>
                                        <span class="email-label">{{ucfirst(auth()->user()->catchPhrase)}}</span>
                                    </div>
                                @endif
                                <div class="container-form-email">
                                    <p>Numéro de téléphone</p>
                                    <span class="email-label">{{auth()->user()->phones()->first()->number}}</span>
                                </div>
                                @if(auth()->user()->phones()->count() > 1 && auth()->user()->phones()->skip(1)->first()->number != null)
                                    <div class="container-form-email">
                                        <p>2<sup>é</sup> Numéro de téléphone</p>
                                        <span
                                            class="email-label">{{auth()->user()->phones()->skip(1)->first()->number}}</span>
                                    </div>
                                @endif
                                @if(auth()->user()->phones()->count() > 2 && auth()->user()->phones()->skip(2)->first()->number != null)
                                    <div class="container-form-email">
                                        <p>3<sup>é</sup> Numéro de téléphone</p>
                                        <span
                                            class="email-label">{{auth()->user()->phones()->skip(2)->first()->number}}</span>
                                    </div>
                                @endif
                                <div class="container-register-form container-register">
                                    <div class="container-form-email">
                                        <p>Nom du commerce</p>
                                        <span class="email-label">{{ucfirst(auth()->user()->name)}}</span>
                                    </div>
                                    @if(auth()->user()->possibily_job == 'no' || auth()->user()->possibily_job == 'yes')
                                        <p>Possibilités d'emplois dans l'entreprise</p>
                                        @if(auth()->user()->possibily_job == 'no')
                                            <div class="container-form-email">
                                                <span>Non</span>
                                            </div>
                                        @else
                                            <div class="container-form-email">
                                                <span>Oui</span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="container-register-form container-register">
                                    <div class="container-form-email">
                                        <p>Adresse du siège social</p>
                                        <span class="email-label">{{auth()->user()->adresses()->first()->postal_adress}}, ({{auth()->user()->adresses()->first()->province()->first()->name}})</span>
                                    </div>
                                </div>
                                @if(auth()->user()->adresses()->count() > 1 && auth()->user()->adresses()->skip(1)->first()->postal_adress != null)
                                    <div class="container-form-email">
                                        <p>2<sup>é</sup> adresse postale</p>
                                        <span
                                            class="email-label">{{auth()->user()->adresses()->skip(1)->first()->postal_adress}}, ({{auth()->user()->adresses()->skip(1)->first()->province()->first()->name}})</span>
                                    </div>
                                @endif
                                @if(auth()->user()->adresses()->count() > 2 && auth()->user()->adresses()->skip(2)->first()->postal_adress != null)
                                    <div class="container-form-email">
                                        <p>3<sup>é</sup> adresse postale</p>
                                        <span
                                            class="email-label">{{auth()->user()->adresses()->skip(2)->first()->postal_adress}}, ({{auth()->user()->adresses()->skip(2)->first()->province()->first()->name}})</span>
                                    </div>
                                @endif
                                @if(auth()->user()->website)
                                    <div class="container-form-email">
                                        <p>Site internet</p>
                                        <span class="email-label">{{auth()->user()->website}}</span>
                                    </div>
                                @endif
                                @if(auth()->user()->websites()->count() > 0 && auth()->user()->websites()->first()->link)
                                    <div class="container-form-email">
                                        <p>2<sup>é</sup> site internet</p>
                                        <span class="email-label">{{auth()->user()->websites()->first()->link}}</span>
                                    </div>
                                    @if(auth()->user()->websites()->count() > 1 && auth()->user()->websites()->skip(1)->first()->link != null)
                                        <div class="container-form-email">
                                            <p>3<sup>é</sup> site internet</p>
                                            <span
                                                class="email-label">{{auth()->user()->websites()->skip(1)->first()->link}}</span>
                                        </div>
                                    @endif
                                @endif
                                @if(auth()->user()->startDate()->count())

                                    <div class="container-form-email selectdiv">
                                        <p>Disponibilités</p>
                                        <div
                                            class="container-filter-categories container-category container-profil-cat">
                                            <ul class="list-categories list-checkboxes-register">
                                                <li class="email-label">
                                                    @foreach($disponibilities as $disponibility)
                                                        <span>
                                                    {{$disponibility->name}}{{ ($loop->last ? '' : ' | ') }}
                                                </span>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="container-register-form container-register container-job-dashboard">
                                    <div class="container-form-email">
                                        <p>Metier</p>
                                        <span class="email-label">{{auth()->user()->job}}</span>
                                    </div>
                                </div>
                                <div class="container-form-email selectdiv">
                                    <p>Catégorie de métier</p>
                                    <div class="container-filter-categories container-category container-profil-cat">
                                        <ul class="list-categories list-checkboxes-register">
                                            <li class="email-label">
                                                @foreach($categories as $c)
                                                    <span>
                                                    {{$c->name}}<span
                                                            class="bar-dividend">{{ ($loop->last ? '' : ' | ') }}</span>
                                                </span>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @if(auth()->user()->pricemax)
                                    <div class="container-form-email" style="    align-self: baseline;">
                                        <p>Votre prix horaire</p>
                                        <span class="email-label">{{auth()->user()->pricemax}}</span>
                                        <span class="horary-cost horary-profil">€/h</span>
                                    </div>
                                @endif

                                <div class="container-register-form container-register">
                                    <div class="container-form-email">
                                        <p>Description</p>
                                        <span>
                                    <p style="color: black"
                                       class="email-label">{{auth()->user()->description}}</p></span>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @if(auth()->user()->facebook != null || auth()->user()->twitter != null || auth()->user()->linkedin != null || auth()->user()->instagram != null)
                            <section class="container-infos-dashboard">
                                <h3 aria-level="3">
                                    Réseaux sociaux
                                </h3>
                                <div class="form-login form-edit-company form-register form-edit-preview">
                                    @if(auth()->user()->facebook != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>Lien facebook</p>
                                                <span class="email-label">{{auth()->user()->facebook}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(auth()->user()->instagram != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>Lien instagram</p>
                                                <span class="email-label">{{auth()->user()->instagram}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(auth()->user()->linkedin != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>Lien linkedin</p>
                                                <span class="email-label">{{auth()->user()->linkedin}}</span>
                                            </div>
                                        </div>
                                    @endif
                                    @if(auth()->user()->twitter != null)
                                        <div class="container-register-form container-register">
                                            <div class="container-form-email">
                                                <p>Lien twitter</p>
                                                <span class="email-label">{{auth()->user()->twitter}}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        @endif
                        @if(auth()->user()->end_plan != null)
                            <div class="register-btn-company">
                                <a href="{{route('dashboard.profil.edit')}}" role="button"
                                   class="button-cta button-edition"
                                   type="submit">
                                    Editer mon profil
                                </a>
                            </div>
                        @endif
                        @else
                            <div @if(auth()->user()->end_plan == null) class="expire-plan" @endif>
                                <div class="form-login form-edit-preview edit-user-profile form-register"
                                     aria-label="Enregistrement d'un compte">
                                    <div class="container-form-email avatar-profil">
                                        <div class="avatar-container">
                                            <p>Photo de profil</p>
                                        </div>
                                        @if(auth()->user()->picture != null)
                                            <img src="{{asset(auth()->user()->picture)}}"
                                                 alt="image de profil de {{auth()->user()->name}}">
                                        @else
                                            <img src="{{asset('svg/user.svg')}}"
                                                 alt="image de profil par défaut">
                                        @endif
                                    </div>
                                    <div class="container-form-email">
                                        <p>Numéro de téléphone</p>
                                        <span
                                            class="email-label">{{auth()->user()->phones()->first()->number}}</span>
                                        @if(auth()->user()->phones()->count() > 1 && auth()->user()->phones()->skip(1)->first()->number != null)
                                            <div class="container-form-email">
                                                <p>2<sup>é</sup> Numéro de téléphone</p>
                                                <span
                                                    class="email-label">{{auth()->user()->phones()->skip(1)->first()->number}}</span>
                                            </div>
                                        @endif
                                        @if(auth()->user()->phones()->count() > 2 && auth()->user()->phones()->skip(2)->first()->number != null)
                                            <div class="container-form-email">
                                                <p>3<sup>é</sup> Numéro de téléphone</p>
                                                <span
                                                    class="email-label">{{auth()->user()->phones()->skip(2)->first()->number}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="container-form-email">
                                        <p>Nom</p>
                                        <span class="email-label"> {{auth()->user()->name}}</span>
                                    </div>
                                    <div class="container-form-email">
                                        <p>Prénom</p>
                                        <span class="email-label">{{auth()->user()->surname}}</span>
                                    </div>
                                    @if(auth()->user()->end_plan != null)
                                        <div class="container-form-email">
                                            <p>Plan : {{$plan->name}}</p>
                                            <span
                                                class="email-label">Date d'expiration le {{auth()->user()->end_plan->locale('fr')->isoFormat('Do MMMM YYYY, H:mm')}}</span>
                                        </div>
                                    @else
                                        <div class="container-form-email">
                                            <p>Plan</p>
                                            <span class="email-label required">EXPIRER</span>
                                        </div>
                                    @endif
                                    <div class="container-form-email">
                                        <p>Email</p>
                                        <span class="email-label">{{auth()->user()->email}}</span>
                                    </div>
                                </div>
                                @if(auth()->user()->end_plan != null)
                                    <div>
                                        <a href="{{route('dashboard.profil.edit')}}" role="button"
                                           class="button-cta button-edition"
                                           type="submit">
                                            Editer mon profil
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
            </div>
        </section>
    </div>
@endsection
