@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="50" height="50" src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{!!session('loveOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('loveNotOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{!!session('loveNotOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('not-permitted'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="good icone">
            <p>{!!session('not-permitted')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin hideForNewsletter" id="sectionWorkerz">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Une profession particulière&nbsp;?
                    </h2>
                    <p>
                        Parmi nos diverses propositions, il ne vous reste plus qu'à trouver celui qui vous conviens
                    </p>
                    @guest
                        <div>
                            <a href="{{route('users.plans')}}" role="button" class="button-cta" type="submit">
                                    J'ajoute mon entreprise
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Online_research.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <livewire:users>

    </livewire:users>
@endsection
