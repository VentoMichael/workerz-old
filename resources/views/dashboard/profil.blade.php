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
                    <div>
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
                                        <img src="{{asset('svg.user.svg')}}"
                                             alt="image de profil par défaut">
                                    @endif
                                </div>
                                <div class="container-form-email">
                                    <p>Numéro de téléphone</p>
                                    <span class="email-label">{{auth()->user()->phones()->first()->number}}</span>
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
                                <div class="container-form-email">
                                    <p>Plan : {{$plan->name}}</p>
                                    <span class="email-label">Date d'expiration le {{$endDatePlan}}</span>
                                </div>
                                <div class="container-form-email">
                                    <p>Email</p>
                                    <span class="email-label">{{auth()->user()->email}}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{route('dashboard.profil.edit')}}" role="button" class="button-cta"
                                   type="submit">
                                    Editer mon profil
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
    <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
@endsection
