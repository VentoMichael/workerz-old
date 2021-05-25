@extends('layouts.app')

@section('content')
    <div class="container-home">
        <section class="container-home_image">
            <div class="container-connexion">
                <h2 aria-level="2">Ou suis-je ?</h2>
                <p>Vous semblez perdu, utilisez le menu ou bien @if(!auth())<a href="{{route('home.index')}}"
                                                                               role="button">retournez à la page
                        d'accueil !</a> @else <a href="{{route('dashboard')}}" role="button">retournez dans mon tableau de bord !</a> @endif </p>
            </div>
            <div class="container-svg">
                <img class="svg-icon" src="{{asset('svg/404.svg')}}"
                     alt="icone 404">
            </div>
        </section>
    </div>
@endsection
