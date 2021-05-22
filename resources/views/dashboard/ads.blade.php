@extends('layouts.appDashboard')
@section('content')
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
                                <form action="/dashboard/ads/{{$firstAd->slug}}" method="get">
                                    <button class="button-cta" name="draftads">Mes brouillons
                                    </button>
                                </form>
                            </section>
                        @endif
                        @if(auth()->user()->announcements()->count())
                            <section>
                                <h3 aria-level="3" class="hidden">
                                    Mes annonces en ligne
                                </h3>
                                <img src="{{asset('svg/ad.svg')}}" alt="Icone d'annonces">
                                <form action="/dashboard/ads/{{$firstAdDraft->slug}}" method="get">
                                    <button class="button-cta" name="adsonline">Mes
                                        annonces
                                        en ligne
                                    </button>
                                </form>
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
