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
            @foreach($plans as $plan)
                <section class="container-plan">
                    <div class="container-plan-price">
                        <h3 aria-level="3">
                            {{ucfirst($plan->name)}}
                        </h3>
                        <span class="planPrice">
                             {{number_format((float)$plan->price, 2, ',', '')}} €
                        </span>
                        @if($plan->oldprice)
                            <p class="reductionPrice">
                                {{$plan->oldprice}} €
                            </p>
                        @endif
                    </div>
                    <ul>
                        <li>
                            <img src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée : {{$plan->duration}} mois
                        </li>
                        <li>
                            @if($plan->priority) <img src="{{asset('svg/good.svg')}}" alt="Icone correct"> @else <img
                                src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Support prioritaire
                        </li>
                        <li>
                            @if($plan->more_visible)
                                <img src="{{asset('svg/good.svg')}}" alt="Icone correct">                                                    @else
                                <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">
                            @endif
                            @if($plan->id == 1)
                                Forte visibilité
                            @endif
                                @if($plan->id == 2)
                                    Votre annonce sera visible {{$plan->id * 3}} fois plus souvent
                                @endif
                                @if($plan->id == 3)
                                    Votre annonce sera visible {{$plan->id * 5}} fois plus souvent
                                @endif
                        </li>
                        <li>
                            @if($plan->hight_visibility) <img src="{{asset('svg/good.svg')}}" alt="Icone correct"> @else
                                <img src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Visible parmis les
                            premiers
                        </li>
                    </ul>
                    <form aria-label="Création d'une annonce" action="{{route('announcements.create')}}" method="post">
                        @method('get')
                        @csrf
                        <input id="plan{{$plan->id}}" name="plan" type="hidden" value="{{$plan->id}}">
                        <button>
                            Je séléctionne {{ucfirst($plan->name)}}
                        </button>
                    </form>
                </section>
            @endforeach
        </div>
    </section>
@endsection
