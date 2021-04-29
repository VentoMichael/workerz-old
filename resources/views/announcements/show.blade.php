@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Aidons {{$announcement->user->name}} {{$announcement->user->surname}}
                    </h2>
                    <p>Prenez contact avec {{$announcement->user->name}} {{$announcement->user->surname}}, soit par mail
                        soit par téléphone. Il s'enverra ravir !</p>
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
            <div class="container-picture-ads">
                @if($announcement->picture)
                    <img src="{{ $announcement->picture }}" alt="photo de profil de {{$announcement->name}}"/>
                @else
                    <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                @endif
            </div>
            <div class="container-infos-perso-ads">
                <h3>
                    {{$announcement->title}}
                </h3>
                <p>
                    {{$announcement->description}}
                </p>
                <div class="container-perso-infos container-six-category-home">
                    <div>
                        <img src="{{asset('svg/envelope.svg')}}" alt="icone de mail">
                        <a href="mailto:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    <div>
                        <img src="{{asset('svg/phone.svg')}}" alt="icone de téléphone">
                        <span>{{$announcement->user->email}}</span>
                    </div>
                    <div>
                        <img src="{{asset('svg/calendar.svg')}}" alt="icone de calendrier">
                        <span>
                            À partir de {{$announcement->startmonth->name}}
                        </span>
                    </div>
                    <div>
                        <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                        <span class="job-cat-ads">
                        <span>{{$announcement->job}}</span>
                        @if($announcement->categories->count())
                                <span class="categoryJob">
                                (@foreach($announcement->categories as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                            </span>
                            @endif
                        </span>
                    </div>
                    <div>
                        <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                        <span>Max : {{$announcement->pricemax}} €</span>
                    </div>
                    <div>
                        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
                        <span>{{$announcement->province->name}}</span>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="container-categories-home margin show-content">
        <h2>
            Ca pourrait vous intéresser
        </h2>
        <div class="container-ads-random">
        @foreach($randomAds as $ra)
            <section class="container-infos-perso-ads container-ad-random">
                <div class="container-picture-ads">
                    @if($announcement->picture)
                        <img src="{{ $announcement->picture }}" alt="photo de profil de {{$announcement->name}}"/>
                    @else
                        <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                    @endif
                </div>
                <div>
                    <h3>
                        {{$ra->title}}
                    </h3>
                </div>
                <div>
                    <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
                    <span>{{$ra->province->name}}</span>
                </div>
                <a href="/announcements/{{$ra->title}}" class="btn-ads button-personnal-announcement">
                </a>
            </section>
        @endforeach
        </div>
    </section>
@endsection
