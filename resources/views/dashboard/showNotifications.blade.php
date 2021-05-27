@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-messages">
            <h2 aria-level="2">
                Mes notifications
            </h2>
            <div class="container-form-ads">
                <div class="container-search-ads">
                    <div
                        class="container-announcments-dashboard"
                        wire:loading.class="load">
                        @forelse($notifications as $notification)
                            <div class="container-message-index">
                                <a class="{{ Request::is('dashboard/messages/'.$notification->id) || Request::is('dashboard/messages/'.$notification->id.'/*') ? "container-announcements-active" : "" }} container-announcements"
                                   href="{{route('dashboard.notificationsShow',[$notification->id])}}"
                                   aria-current="{{ Request::is('dashboard/messages/*') ? "page" : "" }}">
                                    <section>
                                        <img src="{{asset('svg/notif.svg')}}" alt="icone de notification">
                                        <div>
                                            @if($notification->type === 'App\Notifications\AdCreated')
                                                <h3 aria-level="3">
                                                    Votre nouvelle
                                                    annonce {{$notification->data['announcement']['title']}}
                                                </h3>
                                            @else
                                                <h3 aria-level="3">
                                                    Un nouveau message
                                                    de {{$notification->data['message']['user']['name']}}
                                                </h3>
                                            @endif
                                        </div>
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
                <div class="container-messages-all">
                    @foreach($notifications as $notification)
                        @if($notification->type === 'App\Notifications\MessageReceived')
                            <div class="container-message">
                                {{$notification->user()->name}}
                            </div>
                        @endif
                        @if($notification->type === 'App\Notifications\AdCreated')
                            <div>
                                <div class="container-message container-notification">
                                    <img src="{{asset('svg/notif.svg')}}" alt="icone de notifications">
                                    <div>
                                        <h4 aria-level="4">{{$notification->data['announcement']['title']}}</h4>
                                        <p>{{$notification->created_at->locale('fr')->isoFormat('Do MMMM YYYY, H:mm')}}</p>
                                    </div>
                                </div>
                                <div>
                                    <p>Votre nouvelle annonce</p>
                                    <p>
                                        Votre description
                                    </p>
                                    <p>{{$notification->data['announcement']['description']}}</p>
                                    <a class="button-cta"
                                       href="{{route('dashboard.ads.show',$notification->data['announcement']['slug'])}}">Je
                                        veux voir plus de détails</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
