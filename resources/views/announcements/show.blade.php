@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Aidons {{$announcement->user->name}} {{$announcement->user->surname}}
                    </h2>
                    <p>Prenez contact avec {{$announcement->user->name}} {{$announcement->user->surname}}, soit par mail soit par téléphone. Il s'enverra ravir !</p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Great idea_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-categories-home margin">
        <div class="container-categories-text-home">
            <h2 aria-level="2">
                Une annonce {{$randomPhrasing->name}}
            </h2>
        </div>
        <section class="container-personnal-ads show-content">
            <div>
                @if($announcement->picture)
                    <img src="{{ $announcement->picture }}" alt="photo de profil de {{$announcement->name}}"/>
                @else
                    <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                @endif
            </div>
            <div>
                <h3>
                    {{$announcement->title}}
                </h3>
                <p>
                    {{$announcement->description}}
                </p>
                <div class="container-perso-infos container-six-category-home">
                    <div>
                        <img src="{{asset('svg/envelope.svg')}}" alt="icone de mail">
                        <a href="mailo:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    <div>
                        <img src="{{asset('svg/phone.svg')}}" alt="icone de téléphone">
                        <a href="mailo:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    <div>
                        <img src="{{asset('svg/calendar.svg')}}" alt="icone de calendrier">
                        <a href="mailo:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    <div>
                        <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                        <a href="mailo:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    <div>
                        <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                        <a href="mailo:{{$announcement->user->email}}">{{$announcement->pricemax}}</a>
                    </div>
                    <div>
                        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
                        <a href="mailo:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
