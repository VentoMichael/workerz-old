@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Trouvez le professionnel idéal
                    </h2>
                    <p>
                        On vous aide a choisir le meilleur professionnel pour vos demandes
                    </p>
                </div>
                <livewire:search-users>
                </livewire:search-users>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Profiling_Monochromatic.svg')}}"
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
                <a href="{{route('workerz').'?category='.$categorie->id.'#workerzLink'}}">
                    <section class="box-category">
                        <img src="{{asset('svg/'.$categorie->profil)}}" alt="{{$categorie->alt}}">
                        <div itemscope itemtype="http://schema.org/Person">
                            <h3 itemprop="jobTitle" aria-level="3">{{ucfirst($categorie->name)}}</h3>
                            <p>{{$categorie->users->count()}} professionnels</p>
                        </div>
                    </section>
                </a>
            @endforeach
            <a href="{{route('workerz')}}" class="last-box-category box-category">
                <section>
                    <h3 aria-level="3">Toutes les catégories</h3>
                </section>
            </a>
        </div>
    </section>
    <section class="container-home-why show-content">
        <div class="container-title-why">
            <h2 aria-level="2">
                Pourquoi Workerz ?
            </h2>
            <p>
                Nous avons les meilleurs indépendants de votre région
            </p>
        </div>
        <section class="container-why">
            <div>
                <img src="{{asset('svg/Thinking_Monochromatic.svg')}}"
                     alt="Personne réflechissant et assis sur un coussin">
            </div>
            <div class="container-why-text-first">
                <h3 aria-level="3">
                    Arretez de penser !
                </h3>
                <p class="text-why">
                    Vous êtes indépendant et souhaitez vendre vos services au monde entier ?
                </p>
                <p>On vous aide à trouvez du travail !</p>
                @guest
                    <a href="{{route('users.plans')}}" class="button-cta">
                        <button>
                            Je m'inscris
                        </button>
                    </a>
                @endguest
            </div>
        </section>
        <section class="container-why">
            <div class="container-why-text-second">
                <h3 aria-level="3">
                    Un choix immense
                </h3>
                <p class="text-why">
                    Nous recueillons les meilleurs indépendants, avec une vaste gamme de catégories.
                </p>
                <a href="{{route('workerz')}}" class="button-cta">
                    <button>
                        Les indépendants
                    </button>
                </a>
            </div>
            <div>
                <img src="{{asset('svg/Information carousel_Monochromatic.svg')}}"
                     alt="Personne choissisant parmis les nombreux indépendants">
            </div>
        </section>
    </section>
@endsection
@section('scripts')
    @livewireScripts
@endsection
