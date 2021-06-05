@extends('layouts.appDashboard')
@section('content')
    <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/question-signe-en-cercles.svg')}}" alt="good icone">
        <p>Vos notifications seront supprimé 7 jours après lecture</p>
        <span class="crossHide" id="crossHide">&times;</span>
    </div>
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-messages">
            <h2 aria-level="2">
                Mes notifications
            </h2>
            <div class="container-form-ads container-messenger-form container-notification-form">
                <div class="container-search-ads containernotif container-notifications-show">
                    <div
                        class="container-announcments-dashboard"
                        wire:loading.class="load">
                        @forelse($notifications->sortByDesc('created_at')->sortBy('read_at') as $notification)
                            <div class="container-message-index">
                                <a class="{{ Request::is('dashboard/notifications/'.$notification->id) || Request::is('dashboard/notifications/'.$notification->id.'/*') ? "container-announcements-active" : "" }} container-announcements @if($notification->read_at !== null) notificationSeen @endif"
                                   href="{{route('dashboard.notificationsShow',[$notification->id])}}"
                                   aria-current="{{ Request::is('dashboard/notifications/*') ? "page" : "" }}">
                                    <section>
                                        @if($notification->type === 'App\Notifications\AdCreated')
                                            <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonce">

                                            <div>

                                                <h3 aria-level="3">
                                                    Votre nouvelle
                                                    annonce <i>{{$notification->data['announcement']['title']}}
</i>                                                </h3>
                                            </div>
                                        @else
                                            <img src="{{asset('svg/messenger.svg')}}" alt="icone de messages">

                                            <div>
                                                <h3 aria-level="3">
                                                    Un nouveau message
                                                    de <i>{{$notification->data['message']['user']['name']}}</i>
                                                </h3>
                                            </div>
                                        @endif
                                    </section>
                                </a>
                            </div>
                        @empty
                            <div class="container-announcements" style="margin: 0;">
                                <section>
                                    <img src="{{asset('svg/notif.svg')}}" alt="icone de notification">

                                    <div>
                                        <h3 aria-level="3">
                                            Aucune notification trouvée ...
                                        </h3>
                                        <p>
                                            <a href="{{route('dashboard')}}" class="button-cta">Mon tableau de bord</a></p>
                                    </div>
                                </section>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="container-notification-details">
                    @if($n->type === 'App\Notifications\AdCreated')
                        <div>
                            <div class="container-message container-notification">
                                <img src="{{asset('svg/ad.svg')}}" alt="icone de notifications">
                                <div>
                                    <h4 aria-level="4">{{$n->data['announcement']['title']}}</h4>
                                    <p>{{$n->created_at->locale('fr')->isoFormat('Do MMMM YYYY, H:mm')}}</p>
                                </div>
                            </div>
                            <div>
                                <p class="title-notification">Votre nouvelle annonce</p>
                                <p>
                                    Votre description : {{$n->data['announcement']['description']}}</p>
                                <a class="button-cta"
                                   href="{{route('dashboard.ads.show',$n->data['announcement']['slug'])}}">Je
                                    veux voir plus de détails</a>
                            </div>
                        </div>
                    @endif
                    @if($n->type === 'App\Notifications\MessageReceived')
                            <div>
                                <div class="container-message container-notification">
                                    <img src="{{asset('svg/user.svg')}}" alt="icone de notifications">
                                    <div>
                                        <h4 aria-level="4">{{$n->data['message']['user']['name']}}</h4>
                                        <a href="{{$n->data['message']['user']['email']}}">{{$n->data['message']['user']['email']}}</a>
                                        <p>{{$n->created_at->locale('fr')->isoFormat('Do MMMM YYYY, H:mm')}}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="title-notification-msg">Vous avez un nouveau message</p>
                                    <p>{{$n->data['message']['content']}}</p>
                                    <a class="button-cta"
                                       href="{{route('dashboard.messagesShow',$n->data['message']['user']['slug'])}}">Je vais lui répondre</a>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection

