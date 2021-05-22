@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                Annonces
            </h2>
            <div class="container-form-ads">
                <livewire:ads-dashboard>
                </livewire:ads-dashboard>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <h3>
                        Que peux vous apportez une annonce ?
                    </h3>
                    <p>Une annonce vous permets de trouver de nombreux clients potentiels, elle vous permet non seulement d'avoir un choix de clients variant mais elle permet également de vendre/recherchez facilement !</p>
                    <a class="button-cta" href="{{route('announcements.plans')}}">
                        J'en poste une
                    </a>
                </section>
            </div>
        </section>
    </div>
@endsection
