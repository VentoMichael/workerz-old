@extends('layouts.app')

@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">

                <h2 aria-level="2">L'inscription à bout de main&nbsp;!</h2>
                <p>Recherchez vous un travailleur ou en êtes vous un&nbsp;?</p>
                <div>
                    <a href="{{ route('login') }}">
                        <button role="button" class="button-cta" type="submit">
                            J'ai déjà un compte
                        </button>
                    </a>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" class="svg-icon" src="{{asset('svg/Information_carousel_Isometric.svg')}}"
                     alt="Main cliquant sur un écran mobile">
            </div>
        </section>
    </div>
    <section class="container-form-register container-home form-choice show-content">
        <section class="container-role">
            <div class="container-img-register container-picto-register">
                <img width="150" height="150" src="{{asset('svg/user.svg')}}" alt="Photo de profil par défaut d'un utilisateur"></div>
            <h3 aria-level="3">
                Je cherche un professionnel
            </h3>
            <section class="container-advantages">
                <h4 aria-level="4">
                    Les avantages
                </h4>
                <ul class="list-advantages">
                    <li><span>&bull;</span> Accès à un tableau de bord personnel</li>
                    <li><span>&bull;</span> Intègration d'annonces</li>
                    <li><span>&bull;</span> Choix parmi une multitude d'entreprises</li>
                    <li><span>&bull;</span> D'autres avantages intéressants</li>
                </ul>
            </section>
            <div class="container-button-register">
                <form aria-label="Choix d'utilisateur" method="post"
                      action="{{ route('register') }}">
                    @method('get')
                    @csrf
                    <input type="hidden" name="type" value="user">
                    <input id="plan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">
                    <button class="button-cta" title="Je sélectionne la section 'Je cherche un professionnel'"
                            name="user">
                        Je fais ce choix
                    </button>
                </form>
            </div>
        </section>
        <section class="container-role">
            <div class="container-img-register">
                <img width="150" height="150" src="{{asset('svg/suitcase.svg')}}" alt="Photo de profil par défaut d'un professionnel">
            </div>
            <h3 aria-level="3">
                Je suis un professionnel
            </h3>
            <section class="container-advantages">
                <h4 aria-level="4">
                    Les avantages
                </h4>
                <ul class="list-advantages">
                    <li><span>&bull;</span> Accès à un tableau de bord personnel</li>
                    <li><span>&bull;</span> Intègration de plusieurs annonces & de votre entreprise</li>
                    <li><span>&bull;</span> Un portefeuille de clients potentiels</li>
                    <li><span>&bull;</span> D'autres avantages intéressants</li>
                </ul>
            </section>
            <div class="container-button-register">
                <form aria-label="Choix d'utilisateur" method="post"
                      action="{{ route('register') }}">
                    @method('get')
                    @csrf
                    <input id="companyplan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">
                    <input type="hidden" name="type" value="company">

                    <button class="button-cta" title="Je sélectionne la section 'Je suis un professionnel'"
                            name="company">
                        Je fais ce choix
                    </button>
                </form>
            </div>
        </section>
    </section>
@endsection
