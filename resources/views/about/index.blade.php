@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div class="container-about-text">
                <div class="container-home-text">
                    <h2 aria-level="2">
                        À propos de nous
                    </h2>
                    <p>
                        Workerz, créer par <a href="http://ventomichael.site/">Vento Michael</a>, vous donne la
                        possibilité
                        de visez dans le mille !
                    </p>
                </div>
                @guest
                    <div>
                        <a href="{{ route('users.plans') }}">
                            <button role="button" class="button-cta" type="submit">
                                Je m'inscris
                            </button>
                        </a>
                    </div>
                @endguest
                @auth
                    <div>
                        <a href="{{route('announcements.plans')}}">
                            <button role="button" class="button-cta" type="submit">
                                J'ajoute une annonce
                            </button>
                        </a>
                    </div>
                @endauth
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/us.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                Le meilleur pour vous étendre
            </h2>
        </div>
        <div class="container-six-category-home show-content">
            <section class="box-category box-about">
                <img src="{{asset('svg/Video tutorial _Monochromatic.svg')}}"
                     alt="Icone d'un cahier avec une personne voulant écrire dedans">
                <div>
                    <h3 aria-level="3">Développement d'une annonce</h3>
                    <p>Vous aurez la possibilité de développer une annonce afin de trouver un corps de métier dont vous
                        avez besoin</p>
                </div>
            </section>
            <section class="box-category box-about">
                <img src="{{asset('svg/Data analytics _Monochromatic.svg')}}" alt="Icone d'analyser de données">
                <div>
                    <h3 aria-level="3">Déployez votre entreprise</h3>
                    <p>Inscrivez-vous et développer votre entreprise afin d’être contacté parmi des centaines de
                        clients</p>
                </div>
            </section>
            <section class="box-category box-about">
                <img src="{{asset('svg/payment.svg')}}" alt="Icone de deux cartes bancaires">
                <div>
                    <h3 aria-level="3">Aucun paiement nécessaire</h3>
                    <p>Une inscription avec ces fonctionnalités sans paiement, c’est rare.
                    </p>
                    <p>Profiter de ces derniers !</p>
                </div>
            </section>
        </div>
    </section>
    <section class="container-home margin container-about-why show-content">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Notre but grâce à Workerz
                    </h2>
                    <p>
                        Notre mission et d’enlever ces barrières qui vous empêchent d’avancer, grâce à Workerz vous
                        avancerez bien plus rapidement que vous ne le pensez, ne perdez pas de temps
                    </p>
                </div>
                @guest
                    <div>
                        <a href="{{ route('users.plans') }}">
                            <button role="button" class="button-cta" type="submit">
                                Je m'inscris
                            </button>
                        </a>
                    </div>
                @endguest
                @auth
                    <div>
                        <a href="{{route('announcements.plans')}}">
                            <button role="button" class="button-cta" type="submit">
                                J'ajoute une annonce
                            </button>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </section>
@endsection
