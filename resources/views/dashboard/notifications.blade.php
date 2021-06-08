@extends('layouts.appDashboard')
@section('content')
    @if($notifications->count() >0)
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/question-signe-en-cercles.svg')}}" alt="good icone">
            <p>Vos notifications seront supprimé 7 jours après lecture</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
        @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                Notifications
            </h2>
            <div class="container-form-ads container-messenger-form">
                <div class="container-search-ads container-notification-search">
                    <div
                        class="container-announcments-dashboard"
                        wire:loading.class="load">
                        @forelse($notifications->sortByDesc('created_at')->sortBy('read_at') as $notification)
                            <div class="container-message-index">
                                <a class="{{ Request::is('dashboard/messages/'.$notification->id) || Request::is('dashboard/messages/'.$notification->id.'/*') ? "container-announcements-active" : "" }} container-announcements @if($notification->read_at !== null) notificationSeen @endif"
                                   href="{{route('dashboard.notificationsShow',[$notification->id])}}"
                                   aria-current="{{ Request::is('dashboard/messages/*') ? "page" : "" }}">
                                    <section>
                                        @if($notification->type === 'App\Notifications\AdCreated')
                                            <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonce">

                                            <div>

                                            <h3 aria-level="3">
                                                Votre nouvelle
                                                annonce <i>{{$notification->data['announcement']['title']}}</i>
                                            </h3>
                                            </div>
                                            @else
                                            @dd($notification->data['message'])
                                            <img src="{{asset('svg/messenger.svg')}}" alt="icone de messages">
                                            <div>
                                                <h3 aria-level="3">
                                                    Un nouveau message
                                                    de <i>{{$notification->data['message']['receiver']['name']}}</i>
                                                </h3>
                                            </div>
                                        @endif
                                    </section>
                                </a>
                            </div>
                        @empty
                            <div class="container-announcements" style="margin: 0;">
                                <section>
                                    <img src="{{asset('svg/market.svg')}}" alt="icone d'annonce">

                                    <div>
                                        <h3 aria-level="3">
                                            Aucune notification trouvée ...
                                        </h3>
                                    </div>
                                </section>
                            </div>
                        @endforelse
                    </div>
                </div>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-picture-title-dashboard-ads">
                        <div class="container-picture-dashboard">
                            <h4 aria-level="4">
                                Sélectionner une notification pour avoir plus de détails
                            </h4>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
