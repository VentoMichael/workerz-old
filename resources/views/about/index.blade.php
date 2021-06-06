@extends('layouts.app')
@section('content')
    <section class="container-home margin" itemtype="https://schema.org/Organization" itemscope>
        <div class="container-home_image container-home-page">
            <div class="container-about-text">
                <div class="container-home-text">
                    <h2 aria-level="2">
                        À propos de nous
                    </h2>
                    <p>
                        <span itemprop="legalName">Workerz</span>, créé par <a itemprop="founder" href="http://ventomichael.site/">Vento Michael</a>, vous donne la
                        possibilité
                        de viser dans le mille&nbsp;!
                    </p>
                </div>
                @guest
                    @include('partials.btnInscription')
                @endguest
                @auth
                    @include('partials.newAd')
                @endauth
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/us.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                Le meilleur pour développer votre activité
            </h2>
        </div>
        <div class="container-six-category-home show-content container-about-sections">
            <section class="box-category box-about">
                <img width="300" height="300" src="{{asset('svg/Video_tutorial_Monochromatic.svg')}}"
                     alt="Icone d'un cahier avec une personne voulant écrire dedans">
                <div>
                    <h3 aria-level="3" itemprop="makesOffer">Développement d'une annonce</h3>
                    <p>Vous aurez la possibilité de développer une annonce afin de trouver un corps de métier répondant à votre besoin</p>
                </div>
            </section>
            <section class="box-category box-about">
                <img width="300" height="300" src="{{asset('svg/Data_analytics_Monochromatic.svg')}}" alt="Icone d'analyser de données">
                <div>
                    <h3 aria-level="3" itemprop="makesOffer">Déployez votre entreprise</h3>
                    <p>Inscrivez-vous et développez votre entreprise afin d’être mis en relation avec notre portefeuille clients</p>
                </div>
            </section>
            <section class="box-category box-about">
                <img width="300" height="300" src="{{asset('svg/payment.svg')}}" alt="Icone de deux cartes bancaires">
                <div>
                    <h3 aria-level="3">Aucun paiement obligatoire</h3>
                    <p>Une inscription gratuite avec ces fonctionnalités, c’est rare
                    </p>
                    <p>Profitez de ces derniers&nbsp;!</p>
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
                    <p itemprop="knowsAbout">
                        Notre mission est d’enlever ces barrières qui vous empêchent d’avancer. Grâce à Workerz vous avancerez bien plus rapidement que vous ne le pensez, ne perdez pas de temps
                    </p>
                </div>
                @guest
                    @include('partials.btnInscription')
                @endguest
                @auth
                    @include('partials.newAd')
                @endauth
            </div>
        </div>
    </section>
@endsection
