@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                Notifications
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
                                        <img src="{{asset('svg/messenger.svg')}}" alt="icone de messages">
                                        <div>
                                            <h3 aria-level="3">
                                                {{$notification->id}}
                                            </h3>
                                        </div>
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
                                Sélectionné une notification pour avoir plus de détails
                            </h4>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
