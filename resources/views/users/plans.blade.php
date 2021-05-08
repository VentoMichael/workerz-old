@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Le succès est juste derrière !
                    </h2>
                    <p>
                        Après cette étape, votre chiffre d'affaire ne peut qu'augmenter !
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Success _Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads" id="plans">
        <div class="title-first-step-register">
            <h2 aria-level="2">Plan pour votre inscription</h2>
        </div>
        <div class="container-all-announcement show-content container-create-ads-infos container-plans">
            @foreach($plans as $plan)
                <section class="container-plan">
                    <div class="container-plan-price">
                        <h3>
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
                            <img src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée : {{$plan->duration}} jours
                        </li>
                        <li>
                            @if($plan->priority) <img src="{{asset('svg/good.svg')}}" alt="Icone correct"> @else <img src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Support prioritaire
                        </li>
                        <li class="hepling">
                            @if($plan->directly_visible) <img src="{{asset('svg/good.svg')}}" alt="Icone correct"> @else <img src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif
                            Directement visible
                            <span>Visible après approbation de l'administrateur</span>
                        </li>
                        <li>
                            @if($plan->hight_visibility) <img src="{{asset('svg/good.svg')}}" alt="Icone correct"> @else <img src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif Grande visibilité
                        </li>
                    </ul>
                    <form action="{{route('users.type')}}" method="post">
                        @method('get')
                        @csrf
                        <input id="plan_user_id{{$plan->id}}" name="plan_user_id" type="hidden" value="{{$plan->id}}">
                        <button>
                            Je séléctionne {{ucfirst($plan->name)}}
                        </button>
                    </form>
                </section>
            @endforeach
        </div>
    </section>
@endsection
