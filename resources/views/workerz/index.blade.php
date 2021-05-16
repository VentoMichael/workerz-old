@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('loveOk')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('loveNotOk'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('loveNotOk')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('not-permitted'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}" alt="good icone">
            <p>{{Session::get('not-permitted')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Une profession particulière ?
                    </h2>
                    <p>
                        Parmi nos diverses propositions, il ne vous reste plus qu'à trouver celui qui vous conviens
                    </p>
                    @guest
                        <div>
                            <a href="{{route('announcements.plans')}}">
                                <button role="button" class="button-cta" type="submit">
                                    J'ajoute mon entreprise
                                </button>
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Online research.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <livewire:users>

    </livewire:users>
@endsection
@section('scripts')
    @livewireScripts
@endsection
