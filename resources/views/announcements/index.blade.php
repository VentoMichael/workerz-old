@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="pictogramme d'un v correct">
            <p>{!!session('loveOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('loveNotOk'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="pictogramme d'un v correct">
            <p>{!!session('loveNotOk')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('not-permitted'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="pictogramme d'un v correct">
            <p>{!!session('not-permitted')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin hideForNewsletter">
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Une annonce particulière
                    </h2>
                    <p>
                        Parmi les diverses annonces, il ne vous reste plus qu'à trouver l'annonce qui vous convient
                    </p>
                    @include('partials.newAd')
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300" src="{{asset('svg/Information carousel_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <livewire:ads>

    </livewire:ads>
@endsection
