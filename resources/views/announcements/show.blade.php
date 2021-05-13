@extends('layouts.app')
@section('content')
    @if (Session::has('loveOk'))
        <div id="successMsg" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('loveOk')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('loveNotOk'))
        <div id="successMsg" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('loveNotOk')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Aidons {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}
                    </h2>
                    <p>Prenez contact
                        avec {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}, soit par
                        <a
                            href="mailto:{{$announcement->user->email}}">mail</a> soit par <a
                            href="tel:{{$announcement->user->phones->first()->number}}">téléphone</a>. Cette personne
                        s'enverra ravir !</p>
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
            @if($announcement->catchPhrase)
                <h2 aria-level="2">
                    {{ $announcement->catchPhrase }}
                </h2>
            @else
                <h2 aria-level="2">
                    Une annonce {{$randomPhrasing->name}}
                </h2>
            @endif
        </div>
        <section class="container-personnal-ads show-content container-adv">
            <div class="container-love-show">
                @auth
                    <div
                        class="containerPrice container-show-love containerLove help-show @guest notHoverHeart @endguest">
                        @if(!$announcement->isLikedBy($user))
                            <form method="POST" action="/workerz/{{$announcement->slug}}/like">
                                @csrf

                                <button type="submit" class="button-loves">
                                    <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                    <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                         alt="icone de coeur">
                                    <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                            </form>
                        @else

                            <form method="POST" action="/workerz/{{$announcement->slug}}/like">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-loves">
                                    <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                         alt="icone de coeur">
                                    <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                            </form>
                        @endif
                    </div>

                @else
                    <a href="{{route('login')}}">
                        <div class="containerPrice containerLove show-NConnected hepling helping-like help-show">

                            <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                            <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                 alt="icone de coeur">
                            <p>
                                {{$announcement->likes? : 0}}</p>
                            <span> Il faut être connecter pour aimer l'annonce</span>
                        </div>
                    </a>
                @endauth
            </div>


            <div class="container-picture-ads">
                @if($announcement->picture)
                    <img src="{{ $announcement->picture }}" alt="photo de profil de {{ucfirst($announcement->name)}}"/>
                @else
                    <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                @endif
            </div>
            <div class="container-infos-perso-ads">
                <h3 aria-level="3">
                    {{ucfirst($announcement->title)}}
                </h3>
                <p>
                    {{ucfirst($announcement->description)}}
                </p>
                <section class="container-perso-infos container-six-category-home">
                    <h4 aria-level="4" class="hidden">Information de contact</h4>
                    <div>
                        <img src="{{asset('svg/envelope.svg')}}" alt="icone de mail">
                        <a href="mailto:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
                    </div>
                    @foreach($announcement->user->phones as $up)
                        <div>
                            <img src="{{asset('svg/phone.svg')}}" alt="icone de téléphone">
                            <a href="tel:{{$up->number}}">{{$up->number}}</a>
                        </div>
                    @endforeach
                    <div>
                        <img src="{{asset('svg/calendar.svg')}}" alt="icone de calendrier">
                        <span>
                            À partir de {{$announcement->startmonth->name}}
                        </span>
                    </div>
                    <div>
                        <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                        <span class="job-cat-ads">
                        <span>{{ucfirst($announcement->job)}}</span>
                        @if($announcement->categoryAds->count())
                                <span class="categoryJob">
                                (@foreach($announcement->categoryAds as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                            </span>
                            @endif
                        </span>
                    </div>
                    @if(!$announcement->pricemax)
                        <div>
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                            <span>Max : non déterminer</span>
                        </div>
                    @else
                        <div>
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                            <span>Max : {{$announcement->pricemax}} €</span>
                        </div>
                    @endif
                    <div>
                        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
                        <div>
                            @if($announcement->adress)
                                <span>{{$announcement->adress}}</span>
                            @endif
                            <span>{{$ra->province->name}}</span>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </section>
    <section class="container-categories-home margin show-content container-adss-random">
        <div class="container-title-ads">
            <h2 aria-level="2">
                Ca pourrait vous intéresser
            </h2>
        </div>
        <div class="container-ads-random">
            @foreach($randomAds as $ra)
                <section class="container-infos-perso-ads container-ad-random">
                    <div class="container_title__province">
                        <div class="container-love-show">
                            @auth
                                <div
                                    class="containerPrice container-show-love like-ads containerLove help-show @guest notHoverHeart @endguest">
                                    @if(!$ra->isLikedBy($user))
                                        <form method="POST" action="/workerz/{{$ra->slug}}/like">
                                            @csrf

                                            <button type="submit" class="button-loves">
                                                <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                                <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="icone de coeur">
                                                <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                        </form>
                                    @else

                                        <form method="POST" action="/workerz/{{$ra->slug}}/like">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button-loves">
                                                <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="icone de coeur">
                                                <span>
                                        {{$ra->likes ? : 0}}</span></button>
                                        </form>
                                    @endif
                                </div>

                            @else
                                <a href="{{route('login')}}">
                                    <div class="containerPrice containerLove like-ads hepling helping-like help-show">

                                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="icone de coeur">
                                        <p>
                                            {{$ra->likes? : 0}}</p>
                                        <span> Il faut être connecter pour aimer l'entreprise</span>
                                    </div>
                                </a>
                            @endauth
                        </div>
                        <div class="container-picture-ads">
                            @if($ra->picture)
                                <img src="{{ $ra->picture }}"
                                     alt="photo de profil de {{$ra->name}}"/>
                            @else
                                <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                            @endif
                        </div>
                        <div>
                            <h3 aria-level="3">
                                {{ucfirst($ra->title)}}
                            </h3>
                        </div>
                        <div>
                            <div class="container-infos-ads-randomm">
                                <div class="container-position-ads">
                                    <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
                                    <div>
                                        @if($announcement->adress)
                                            <p>{{$announcement->adress}}</p>
                                        @endif
                                        <p>{{$ra->province->name}}</p>
                                    </div>
                                </div>
                                <div class="container-position-ads">
                                    <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                                    <span class="job-cat-ads">
                                    <p>{{ucfirst($ra->job)}}</p>
                                    @if($ra->categoryAds->count())
                                            <p class="categoryJob">
                                            (@foreach($ra->categoryAds as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                        </p>
                                        @endif
                                </span>
                                </div>
                            </div>
                        </div>
                        <a href="/announcements/{{$ra->slug}}" class="btn-ads button-personnal-announcement">
                        </a>
                </section>
            @endforeach
        </div>
    </section>
@endsection
