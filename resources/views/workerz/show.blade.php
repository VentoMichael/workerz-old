@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Vous avez fais le bon choix !
                    </h2>
                    <p>Prenez contact avec {{ucfirst($worker->name)}}, soit par <a
                            href="mailto:{{$worker->email}}">mail</a> soit par <a
                            href="tel:{{$worker->phones()->first()->number}}">téléphone</a>. Cette entreprise s'enverra
                        ravir !</p>
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
                Une entreprise{{$randomPhrasing->name}}
            </h2>
        </div>
        <section class="container-personnal-ads show-content">
            <div class="container-picture-ads">
                @if($worker->picture)
                    <img src="{{ $worker->picture }}" alt="photo de profil de {{ucfirst($worker->name)}}"/>
                @else
                    <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                @endif
            </div>
            <div class="container-infos-perso-ads">
                <h3>
                    {{ucfirst($worker->name)}}
                </h3>
                <p>
                    {{ucfirst($worker->description)}}
                </p>
                <section class="container-perso-infos container-six-category-home">
                    <h4 aria-level="4" class="hidden">Information de contact</h4>
                    <div>
                        <img src="{{asset('svg/envelope.svg')}}" alt="icone de mail">
                        <a href="mailto:{{$worker->email}}">{{$worker->email}}</a>
                    </div>
                    @foreach($worker->phones as $up)
                        <div>
                            <img src="{{asset('svg/phone.svg')}}" alt="icone de téléphone">
                            <a href="tel:{{$up->number}}">{{$up->number}}</a>
                        </div>
                    @endforeach
                    <div>
                        <img src="{{asset('svg/calendar.svg')}}" alt="icone de calendrier">
                        <span>
                            Ouvert le : @foreach($worker->startDateUser as $ws){{substr($ws->name, 0, 3)}}{{ ($loop->last ? '' : ', ') }}@endforeach
                        </span>
                    </div>
                    <div>
                        <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                        <span class="job-cat-ads">
                        <span>{{ucfirst($worker->job)}}</span>
                        @if($worker->categoryUser->count())
                                <span class="categoryJob">
                                (@foreach($worker->categoryUser as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                            </span>
                            @endif
                        </span>
                    </div>
                    <div>
                        <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                        <span>Un minimum de {{$worker->pricemax}}€/h</span>
                    </div>
                    <div>
                        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
                        <span>{{$worker->postal_adress}} ({{$worker->province->name}})</span>
                    </div>
                </section>
            </div>
        </section>
    </section>
    <section class="container-categories-home margin show-content container-adss-random">
        <div class="container-title-ads">
            <h2>
                Ca pourrait vous intéresser
            </h2>
        </div>
        <div class="container-ads-random">
            @foreach($randomUsers as $ra)
                <section class="container-infos-perso-ads container-ad-random">
                    <div class="container_title__province">
                        <div class="container-picture-ads">
                            @if($worker->picture)
                                <img src="{{ $worker->picture }}"
                                     alt="photo de profil de {{$worker->name}}"/>
                            @else
                                <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                            @endif
                        </div>
                        <div>
                            <h3>
                                {{ucfirst($ra->name)}}
                                {{ucfirst($ra->surname)}}
                            </h3>
                        </div>
                        <div class="container-infos-ads-randomm">
                            <div class="container-position-ads">
                                <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
                                <span>{{$ra->province->name}}</span>
                            </div>
                            <div class="container-position-ads">
                                <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                                <span class="job-cat-ads">
                                    <span>{{ucfirst($ra->job)}}</span>
                                    @if($ra->categoryUser->count())
                                        <span class="categoryJob">
                                            (@foreach($ra->categoryUser as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <a href="/announcements/{{$ra->title}}" class="btn-ads button-personnal-announcement">
                    </a>
                </section>
            @endforeach
        </div>
    </section>
@endsection
