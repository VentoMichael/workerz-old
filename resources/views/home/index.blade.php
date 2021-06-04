@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Trouver le professionnel idéal
                    </h2>
                    <p>
                        On vous aide à choisir le professionnel idéal pour vos demandes
                    </p>
                </div>
                <livewire:search-users>
                </livewire:search-users>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Profiling_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                Les professionnels par catégories
            </h2>
            <p class="text-categories-home">Choisissez une catégorie parmi les plus populaires</p>
        </div>
        <div class="container-six-category-home show-content">
            @foreach($categories as $categorie)
                <section>
                    <a class="box-category"
                       href="{{route('workerz').'?categoryUser%5B%5D='.$categorie->id.'#workerzLink'}}">
                        <img width="300" height="300" src="{{asset('svg/'.$categorie->profil)}}"
                             alt="{{$categorie->alt}}">
                        <div itemscope itemtype="https://schema.org/Person">
                            <h3 itemprop="jobTitle" aria-level="3">{{ucfirst($categorie->name)}}</h3>
                            <p>{{$categorie->users->count()}} professionnels</p>
                        </div>
                    </a>
                </section>
            @endforeach
            <section>
                <a class="last-box-category box-category" href="{{route('workerz')}}">
                    <h3 aria-level="3">Toutes les catégories</h3>
                </a>
            </section>
        </div>
    </section>
    <section class="container-home-why show-content">
        <div class="container-title-why">
            <h2 aria-level="2">
                Pourquoi Workerz&nbsp;?
            </h2>
            <p>
                Nous avons les indépendants les plus reconnus de votre région
            </p>
        </div>
        <section class="container-why">
            <div>
                <img width="400" height="350" src="{{asset('svg/Thinking_Monochromatic.svg')}}"
                     alt="Personne réflechissant et assis sur un coussin">
            </div>
            <div class="container-why-text-first">
                <h3 aria-level="3">
                    Arretez de penser&nbsp;!
                </h3>
                <p class="text-why">
                    Vous êtes indépendant et souhaitez proposer vos services à notre portefeuille clients&nbsp;?
                </p>
                <p>On vous aide à trouver du travail&nbsp;!</p>
                @guest
                    @include('partials.btnInscription')
                @endguest
            </div>
        </section>
        <section class="container-why">
            <div class="container-why-text-second">
                <h3 aria-level="3">
                    Un choix immense
                </h3>
                <p class="text-why">
                    Nous affilions les meilleurs indépendants, proposant une vaste gamme de catégories.
                </p>
                <a href="{{route('workerz')}}" class="button-cta">
                    Les indépendants
                </a>
            </div>
            <div>
                <img width="400" height="350" src="{{asset('svg/Information carousel_Monochromatic.svg')}}"
                     alt="Personne choissisant parmis les nombreux indépendants">
            </div>
        </section>
        <section class="container-why">
            <div>
                <img width="400" height="350" src="{{asset('svg/Marketing _Monochromaticc.svg')}}"
                     alt="Personne réflechissant et assis sur un coussin">
            </div>
            <div class="container-why-text-first">
                <h3 aria-level="3">
                    Vendez vos services ou recherché en&nbsp;!
                </h3>
                <p class="text-why">
                    Vous avez besoin d'un indépendant ou vous souhaitez proposer vos services&nbsp;?
                </p>
                <a href="{{route('announcements.plans')}}" class="button-cta">
                    Je poste une annonce
                </a>
            </div>
        </section>
    </section>
@endsection
@section('scripts')
    @livewireScripts
@endsection
