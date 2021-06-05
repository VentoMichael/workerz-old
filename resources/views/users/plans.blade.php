@extends('layouts.app')
@section('content')
    @if (Session::has('errors'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60"
                                                                  src="{{asset('svg/cross.svg')}}" alt="good icone">
            <p>{!!session('errors')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Le succès est juste derrière&nbsp;!
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
        @if(auth()->user())
            <div class="container-link-to-back container-change-plan">
                <a class="link-back button-back button-cta button-draft" href="{{route('dashboard.profil')}}">
                    Retour
                </a>
            </div>
        @endif
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
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée
                            : @if($plan->id == 1) {{$plan->duration}} jours @else {{$plan->duration / 30}} mois @endif
                        </li>
                        <li>
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">
                            @if($plan->id == 1) Support basique @elseif($plan->id == 2) Support
                            intermédiaire @elseif($plan->id == 3) Support prioritaire @endif
                        </li>
                        <li class="container-visibility">
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">
                            @if($plan->id == 1)
                                Basse visibilité
                            @endif
                            @if($plan->id == 2)
                                Moyenne visibilité
                            @endif
                            @if($plan->id == 3)
                                Haute visibilité
                            @endif *
                        </li>
                        <li class="container-visibility">
                            <img width="40" height="60" src="{{asset('svg/good.svg')}}"
                                 alt="Icone correct">@if($plan->id == 1)  Visible parmis les top
                            100 @elseif($plan->id == 2)  Visible parmis les top 15 @elseif($plan->id == 3)  Visible
                            parmis les top 4 @endif *
                        </li>
                    </ul>
                    <form aria-label="Choix du plan pour devenir utilisateur" @auth action="{{route('users.payed')}}"
                          @else action="{{route('users.type')}}" @endauth method="post">
                        @method('get')
                        @csrf
                        <input id="plan{{$plan->id}}" name="plan" type="hidden" value="{{$plan->id}}">
                        <button class="buttonChanged">
                            Je séléctionne {{ucfirst($plan->name)}}
                        </button>
                    </form>
                </section>
            @endforeach
        </div>
    </section>
@endsection
@if(auth()->user())
@section('scripts')
    <script>let btns=document.querySelectorAll('.buttonChanged')
        function confirmDelete(e){return!0===confirm("Après cette étape, le nouveau plan sera actif")||(e.preventDefault(),!1)}
        btns.forEach(function(btn){btn.addEventListener("click",confirmDelete)})</script>
@endsection
@endif
