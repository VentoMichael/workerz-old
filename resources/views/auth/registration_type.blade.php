@extends('layouts.app')

@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">

                <h2 aria-level="2">L'inscription à bout de main !</h2>
                <p>Êtes vous un utilisateur ou un indépendant ?</p>
                <div>
                    <a href="{{ route('login') }}">
                        <button role="button" class="button-cta" type="submit">
                            J'ai déjà un compte
                        </button>
                    </a>
                </div>
            </div>
            <div class="container-svg">
                <img class="svg-icon" src="{{asset('svg/Information_carousel_Isometric.svg')}}"
                     alt="Main cliquant sur un écran mobile">
            </div>
        </section>
    </div>
    <section class="container-form-register container-home">

        <form class="form-choice" method="post"
              action="{{ route('register') }}">
            @method('get')
            @csrf
            <section class="container-role">
                <div class="container-img-register">
                    <img src="{{asset('svg/user.svg')}}" alt="Photo de profil par défaut d'un utilisateur"></div>
                <h3 aria-level="3">
                    Je cherche un professionnel
                </h3>
                <section class="container-advantages">
                    <h4 aria-level="4">
                        Les avantages
                    </h4>
                    <ul class="list-advantages">
                        <li><span>&bull;</span> Accès à un tableau de bord personnel</li>
                        <li><span>&bull;</span> Intègration d'une annonce</li>
                        <li><span>&bull;</span> Choix parmi une multitude d'entreprises</li>
                        <li><span>&bull;</span> Pleins d'autres avantages</li>
                    </ul>
                </section>
                <div class="container-button-register">
                    <button class="button-cta" name="user">
                        Je fais ce choix
                    </button>
                </div>
            </section>
            <section class="container-role">
                <div class="container-img-register">
                    <img src="{{asset('svg/suitcase.svg')}}" alt="Photo de profil par défaut d'un professionnel">
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
                        <li><span>&bull;</span> Intègration d'une annonce & de votre entreprise</li>
                        <li><span>&bull;</span> Des centaines de clients potentiels</li>
                        <li><span>&bull;</span> Pleins d'autres avantages</li>
                    </ul>
                </section>
                <div class="container-button-register">
                                        <input id="plan_user_id{{$plan}}" name="plan_user_id" type="hidden" value="{{$plan}}">

                    <button class="button-cta" name="company">
                        Je fais ce choix
                    </button>
                </div>
            </section>
        </form>
    </section>

@endsection
