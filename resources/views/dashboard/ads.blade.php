@extends('layouts.appDashboard')
@section('content')
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
    @if (Session::has('success-delete'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('success-delete')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                Annonces
            </h2>
            <div>
                <div class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-draftads">
                        @if(auth()->user()->announcements()->Draft()->count())
                            <section>
                                <h3 aria-level="3" class="hidden">
                                    Mes brouillons
                                </h3>
                                <img src="{{asset('svg/draft.svg')}}" alt="Icone d'annonces brouillon">
                                <a class="button-cta button-edition" href="ads/draft/{{$firstAdDraft->slug}}">
                                    Mes brouillons
                                </a>
                            </section>
                        @endif
                        @if(auth()->user()->announcements()->NotDraft()->count())
                            <section>
                                <h3 aria-level="3" class="hidden">
                                    Mes annonces en ligne
                                </h3>
                                <img src="{{asset('svg/ad.svg')}}" alt="Icone d'annonces">
                                <a class="button-cta button-edition" href="ads/{{$firstAd->slug}}">
                                    Mes
                                    annonces
                                    en ligne
                                </a>
                            </section>
                        @endif
                    </div>
                    <section class="container-ads-give">
                        <h3>
                            Que peux vous apportez une annonce ?
                        </h3>
                        <p>Une annonce vous permets de trouver de nombreux clients potentiels, elle vous permet non
                            seulement d'avoir un choix de clients variant mais elle permet également de
                            vendre/recherchez facilement !</p>
                        <a class="button-cta button-edition" href="{{route('announcements.plans')}}">
                            J'en poste une
                        </a>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
