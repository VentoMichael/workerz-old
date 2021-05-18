@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('expireAds'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/caution.svg')}}" alt="good icone">
            <p>{{Session::get('expireAds')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="cross icone">
            <p>{{Session::get('success-inscription')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('errors'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}" alt="cross icone">
            <p>{{Session::get('errors')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard">
            <h2 aria-level="2">
                Tableau de bord
            </h2>
            <div class="container-sections-dashboard">
                <section class="container-dashboard-notif">
                    <h3>
                        Notifications
                    </h3>
                    <div class="container-picto-dashboard">
                        <div class="container-messages">
                            <div class="messages-container">
                                <div class="container-horary-notification-dashboard">
                                    <p>
                                        15:32
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Vous avez reçu un message de Anna Roberto
                                    </p>
                                </div>
                            </div>
                            <div class="messages-container">
                                <div class="container-horary-notification-dashboard">
                                    <p>
                                        15:32
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Vous avez reçu un message de Anna Roberto
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="button-dashboard-notifications">
                            <a class="button-cta" href="{{route('dashboard.notifications')}}">
                                Toutes les notifications
                            </a>
                        </div>
                    </div>
                </section>
                <section class="container-dashboard-notif container-dashboard-messenger">
                    <h3>
                        Messages
                    </h3>
                    <div class="container-picto-dashboard">
                        <div class="container-messages">
                            <div class="messages-container">
                                <div class="container-horary-notification-dashboard">
                                    <p>
                                        15:32
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Vous avez reçu un message de Anna Roberto
                                    </p>
                                </div>
                            </div>
                            <div class="messages-container">
                                <div class="container-horary-notification-dashboard">
                                    <p>
                                        15:32
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        Vous avez reçu un message de Anna Roberto
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="button-dashboard-notifications">
                            <a class="button-cta" href="{{route('dashboard.notifications')}}">
                                Tous mes messages
                            </a>
                        </div>
                    </div>
                </section>
                <section class="container-dashboard-notif container-dashboard-ads">
                    <h3>
                        Annonces
                    </h3>
                    <div class="container-picto-dashboard">
                        <div class="container-messages">
                            <div class="messages-container">
                                <div class="container-horary-notification-dashboard">
                                    <p>
                                        Titre de l'annonce
                                    </p>
                                </div>
                                <div>
                                    <p class="dateAds">
                                        Actif jusqu'au 29 mars, 2021
                                    </p>
                                </div>
                            </div>
                            <div class="messages-container">
                                <div class="container-horary-notification-dashboard">
                                    <p>
                                        Titre de l'annonce
                                    </p>
                                </div>
                                <div>
                                    <p class="dateAds">
                                        Actif jusqu'au 29 mars, 2021
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="button-dashboard-notifications">
                            <a class="button-cta" href="{{route('dashboard.notifications')}}">
                                Toutes mes annonces
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
