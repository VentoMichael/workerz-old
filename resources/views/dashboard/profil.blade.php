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
        <section class="container-dashboard container-profil">
            <h2 aria-level="2">
                Profil
            </h2>
            <div class="container-profil-dashboard">
                @if(auth()->user()->role_id == 2)
                    @include('layouts.formCompany')
                @else
                    @if(auth()->user()->end_plan == null)
                        <div class="container-button-expire">
                            <a href="{{route('usersAlready.plans')}}" class="button-cta button-expire">
                                Je choisis mon plan
                            </a>
                        </div>
                    @endif
                    <div @if(auth()->user()->end_plan == null) class="expire-plan" @endif>
                        <div class="form-login form-edit-preview form-register"
                             aria-label="Enregistrement d'un compte">
                            <div class="container-register-form container-register">
                                <div class="container-form-email avatar-profil">
                                    <div class="avatar-container">
                                        <p>Photo de profil</p>
                                    </div>
                                    @if(auth()->user()->picture != null)
                                        <img src="{{auth()->user()->picture}}"
                                             alt="image de profil de {{auth()->user()->name}}">
                                    @else
                                        <img src="{{asset('svg/user.svg')}}"
                                             alt="image de profil par défaut">
                                    @endif
                                </div>
                                <div class="container-form-email">
                                    <p>Numéro de téléphone</p>
                                    <span class="email-label">{{auth()->user()->phones()->first()->number}}</span>
                                    @if(auth()->user()->phones()->count() > 1 && auth()->user()->phones()->skip(1)->first()->number != null)
                                        <div class="container-form-email">
                                            <p>2<sup>é</sup> Numéro de téléphone</p>
                                            <span class="email-label">{{auth()->user()->phones()->skip(1)->first()->number}}</span>
                                        </div>
                                    @endif
                                    @if(auth()->user()->phones()->count() > 2 && auth()->user()->phones()->skip(2)->first()->number != null)
                                        <div class="container-form-email">
                                            <p>3<sup>é</sup> Numéro de téléphone</p>
                                            <span class="email-label">{{auth()->user()->phones()->skip(2)->first()->number}}</span>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="container-register-form container-register">
                                <div class="container-form-email">
                                    <p>Nom</p>
                                    <span class="email-label"> {{auth()->user()->name}}</span>
                                </div>
                                <div class="container-form-email">
                                    <p>Prénom</p>
                                    <span class="email-label">{{auth()->user()->surname}}</span>
                                </div>
                            </div>
                            <div class="container-register-form container-register">
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
                                    <a href="{{route('dashboard.profil.edit')}}" role="button" class="button-cta"
                                       type="submit">
                                        Editer mon profil
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
