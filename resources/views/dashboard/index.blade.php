@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('expire'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/caution.svg')}}" alt="good icone">
            <p>{!!session('expire')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-inscription'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="cross icone">
            <p>{!!session('success-inscription')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('errors'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}" alt="cross icone">
            <p>{!!session('errors')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard">
            <h2 aria-level="2">
                Tableau de bord
            </h2>
            <div class="container-sections-dashboard container-dashboards">
                <section class="container-dashboard-notif">
                    <h3 aria-level="3">
                        Les dernières notifications
                    </h3>
                    <div class="container-picto-dashboard">
                        <div class="container-messages">
                            @forelse($notifications->sortByDesc('created_at') as $notification)
                                <div class="messages-container">
                                    <div class="container-horary-notification-dashboard">
                                        @if($notification->created_at->isToday())
                                            <p>
                                                Aujourd'hui, {{$notification->created_at->locale('fr')->isoFormat('H:mm')}}
                                            </p>
                                        @else
                                            <p>
                                                {{$notification->created_at->locale('fr')->isoFormat('Do MMMM YYYY, H:mm')}}
                                            </p>
                                        @endif
                                    </div>
                                    @if($notification->type === 'App\Notifications\AdCreated')
                                        <div class="container-notifications-dashboard">
                                            <img itemprop="image" src="{{asset('svg/ad.svg')}}"
                                                 alt="icone d'annonces">
                                            <h4 aria-level="4">
                                                Votre annonce <i>{{$notification->data['announcement']['title'] }}</i> est en
                                                ligne&nbsp;!
                                            </h4>
                                        </div>
                                    @endif
                                    @if($notification->type === 'App\Notifications\MessageReceived')
                                        <div class="container-notifications-dashboard">
                                            <img itemprop="image" src="{{asset('svg/messenger.svg')}}"
                                                 alt="icone de messages">
                                            <h4 aria-level="4">
                                                Vous avez reçu un message
                                                de <i>{{$notification->data['message']['user']['name'] }}</i>
                                            </h4>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="messages-container">
                                    <h4 aria-level="4">
                                        Aucune notification pour le moment
                                    </h4>
                                </div>
                            @endforelse
                        </div>
@if($notifications->count() >0)
                        <div class="button-dashboard-notifications">
                            <a class="button-cta button-edition" href="{{route('dashboard.notifications')}}">
                                Toutes les notifications
                            </a>
                        </div>
    @endif
                    </div>
                </section>
                <section class="container-dashboard-notif container-dashboard-messenger">
                    <h3>
                        Les 3 derniers messages
                    </h3>
                    <div class="container-picto-dashboard">
                        @forelse($messages as $message)
                            <section class="messages-container">
                                <div class="container-horary-notification-dashboard container-index-dashboard">
                                    <div class="container-horary-notification-dashboard">
                                        <p>
                                            Reçu le {{$message->created_at->locale('fr')->isoFormat('Do MMMM, HH:ss')}}
                                        </p>
                                    </div>
                                    <div>
                                        <h4 aria-level="4">
                                            Vous avez reçu un message de la part
                                            de <i>
                                            {{ucfirst($message->user->name)}} {{ucfirst($message->user->surname)}}</i>
                                        </h4>
                                    </div>
                                </div>
                            </section>
                        @empty
                            <section class="messages-container">
                                <h4 aria-level="4">
                                    Aucun message trouvé ...
                                </h4>
                                <div class="button-dashboard-notifications">
                                    <a class="button-cta button-edition button-personnal-dashboard"
                                       href="{{route('announcements')}}">
                                        Je vais voir les annonces
                                    </a>
                                </div>
                            </section>
                        @endforelse
                        @if($messages->count() >0)
                        <div class="button-dashboard-notifications">
                            <a class="button-cta button-edition button-msg-dash button-msg-dashboard" href="{{route('dashboard.messages')}}">
                                Tous mes messages
                            </a>
                        </div>
                            @endif
                    </div>
                </section>
                <section class="container-dashboard-notif container-dashboard-ads">
                    <h3 aria-level="3">
                        Les 3 annonces ayant le plus de succés
                    </h3>
                    <div class="container-picto-dashboard">
                        <div class="container-messages container-ads-index">
                            @forelse($lastAnnouncements as $ad)
                                <section class="messages-container">
                                    <div class="container-horary-notification-dashboard container-index-dashboard">
                                        <div style="align-self: center;">
                                            @if($ad->picture)
                                                <img itemprop="image" src="{{ asset($ad->picture) }}"
                                                     alt="photo de profil de {{ucfirst($ad->title)}}"/>
                                            @else
                                                <img itemprop="image" src="{{asset('svg/ad.svg')}}"
                                                     alt="icone d'annonces">
                                            @endif
                                        </div>

                                        <h4 aria-level="4">
                                            <i>{{ucfirst($ad->title)}}</i>
                                        </h4>
                                    </div>
                                    <div>
                                        <p class="dateAds">
                                            Actif jusqu'au {{$ad->created_at->locale('fr')->isoFormat('Do MMMM, YYYY')}}
                                        </p>
                                    </div>
                                    <div class="container-counter-view">
                                        <p class="view-counter view-counter-dashboard">{{ $ad->view_count }} @if($ad->view_count >1 )
                                                vues @else vue @endif</p>
                                        <p class="view-like view-counter-dashboard">{{$ad->likes ? : 0}} @if($ad->likes == null || $ad->likes <= 1)
                                                j'aime @else j'aimes @endif</p>
                                    </div>
                                    <div class="button-dashboard-notifications">
                                        <a class="button-cta button-edition button-personnal-dashboard"
                                           href="dashboard/ads/{{$ad->slug}}">
                                            Voir <i>{{ucfirst($ad->title)}}</i>
                                        </a>
                                    </div>
                                </section>
                            @empty
                                <section class="messages-container">
                                    <h4 aria-level="4">
                                        Aucune annonce trouvée ...
                                    </h4>
                                    <div class="button-dashboard-notifications">
                                        <a class="button-cta button-edition button-personnal-dashboard"
                                           href="{{route('announcements.plans')}}">
                                            J'en poste une
                                        </a>
                                    </div>
                                </section>
                            @endforelse
                            @if($lastAnnouncements->count() >0)
                            <div class="button-dashboard-notifications">
                                <a class="button-cta button-edition" href="{{route('dashboard.ads')}}">
                                    Toutes mes annonces
                                </a>
                            </div>
                                @endif
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
