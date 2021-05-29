@extends('layouts.app')
@section('content')
    @if (Session::has('errors'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="good icone">
            <p>{{Session::get('errors')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Le succès est juste derrière !
                    </h2>
                    <p>
                        Par après, votre serez visible parmis un grand nombre de clients potentiels
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Success _Monochromatic.svg')}}"
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
                        <h3 aria-level="3">
                            {{ucfirst($plan->name)}}
                        </h3>
                        <span class="planPrice">
                             {{number_format((float)$plan->price, 2, ',', '')}} €
                        </span>
                        @if($plan->price != 0)
                            <span class="planPrice monthCost">
                             ({{number_format((float) 1 * ($plan->price/$plan->duration) * 30 , 2, ',', '')}} € / mois)
                        </span>
                        @endif
                        @if($plan->oldprice)
                            <p class="reductionPrice">
                                {{$plan->oldprice}} €
                            </p>
                        @endif
                    </div>
                    <ul>
                        <li>
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée : @if($plan->id == 1) {{$plan->duration}} jours @else {{$plan->duration / 30}} mois @endif
                        </li>
                        <li>
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">
                            @if($plan->id == 1) Support basique @elseif($plan->id == 2) Support intermédiaire @elseif($plan->id == 3) Support prioritaire @endif
                        </li>
                        <li class="container-visibility">
                            @if($plan->more_visible) <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct"> @else
                                <img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif
                            @if($plan->id == 1)
                                Forte visibilité
                            @endif
                            @if($plan->id == 2)
                                Votre entreprise sera visible {{$plan->id * 3}} fois plus souvent
                            @endif
                            @if($plan->id == 3)
                                Votre entreprise sera visible {{$plan->id * 5}} fois plus souvent
                            @endif *
                        </li>
                        <li class="container-visibility">
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">@if($plan->id == 1)  Visible parmis les 100 premiers @elseif($plan->id == 2)  Visible parmis les premiers 15 premiers @elseif($plan->id == 3)  Visible parmis les 4 premiers @endif *
                        </li>
                    </ul>
                    <form aria-label="Choix du plan pour devenir utilisateur" @auth action="{{route('users.payed')}}" @else action="{{route('users.type')}}" @endauth method="post">
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
