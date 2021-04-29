@extends('layouts.app')
@section('content')
    <section class="container-home margin">
    <div class="container-home_image container-home-create container-home-page">
        <div>
            <div class="container-home-text">
                <h2 aria-level="2">
                    Des clients vous attendent
                </h2>
                <p>
                    Après cette étape, votre annonce sera visible parmis beaucoup de potentiels clients !
                </p>
            </div>
        </div>
        <div class="container-svg">
            <img src="{{asset('svg/Success _Monochromatic.svg')}}"
                 alt="Personne choissisant la catégorie de métier">
        </div>
    </div>
</section>
<section class="container-home container-announcements container-create-ads">
    <div class="title-first-step-register">
        <h2 aria-level="2">Plan pour votre annonce</h2>
    </div>
    <div class="container-all-announcement show-content container-create-ads-infos container-plans">
        @for($i=1;$i<= 3;$i++)
        <section class="container-plan">
            <div class="container-plan-price">
                <h3>
                    Free
                </h3>
                <span class="planPrice">
                                0€
                            </span>
                <p class="reductionPrice">
                    10€
                </p>
            </div>
            <ul>
                <li>
                    <img src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée : X jours
                </li>
                <li>
                    <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">Support prioritaire
                </li>
                <li class="hepling">
                    <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">
                    Directement visible
                    <span>Visible après approbation de l'administrateur</span>
                </li>
                <li>
                    <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">Grande visibilité
                </li>
            </ul>
            <form action="{{route('announcements.create')}}" method="get">
                @csrf
                <button name="plan{{$i}}">
                    Je séléctionne TITRE
                </button>
            </form>
        </section>
        @endfor
    </div>
</section>
@endsection