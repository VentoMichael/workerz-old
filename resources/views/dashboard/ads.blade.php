@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                Annonces
            </h2>
            <div class="container-form-ads">
                <div class="container-search-ads">
                    <form action="{{route('dashboard.ads')}}" aria-label="Rechercher mes annonces" role="search"
                          method="get" class="formSearchAd">
                        <label for="search" class="hidden">Rechercher mes annonces</label>
                        <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                               placeholder="Rechercher par nom"
                               class="search-announcement search-home search-ads">
                        <noscript>
                            <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
                        </noscript>
                    </form>
                    <section class="container-announcements container-announcements-active">
                        <div>
                            <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonce">
                        </div>
                        <div>
                            <h3 aria-level="3">
                                Annonce peu commune
                            </h3>
                            <p class="view-counter">500 vues</p>
                        </div>
                    </section>
                </div>
                <div class="container-profil-dashboard">

                </div>
            </div>
        </section>
    </div>
@endsection
