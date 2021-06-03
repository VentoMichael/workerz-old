@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('success-update-not'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="good icone">
            <p>{{Session::get('success-update-not')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="good icone">
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
                                <img width="150" height="150" src="{{asset('svg/draft.svg')}}" alt="Icone d'annonces brouillon">
                                <a class="button-cta button-edition" href="ads/draft/{{$firstAdDraft->slug}}">
                                    Mes brouillons
                                </a>
                            </section>
                        @endif
                        @if(auth()->user()->announcements()->NotDraft()->count())
                            <section>
                                <h3 aria-level="3" class="hidden">
                                    Mes annonces
                                </h3>
                                <img width="150" height="150" src="{{asset('svg/ad.svg')}}" alt="Icone d'annonces">
                                <a class="button-cta button-edition" href="ads/{{$firstAd->slug}}">
                                    Mes annonces
                                </a>
                            </section>
                        @endif
                    </div>
                    <section class="container-ads-give">
                        <h3>
                            Que peux vous apporter une annonce&nbsp;?
                        </h3>
                        <p>Une annonce vous permet de trouver de nombreux clients potentiels.
                            Elle vous permet non seulement d'avoir un choix de clients varié mais permet également de vendre ou de rechercher facilement&nbsp;!</p>
                        <a class="button-cta button-edition" href="{{route('announcements.plans')}}">
                            J'en poste une
                        </a>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
