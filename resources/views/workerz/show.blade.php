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
            <div class="container-love-show">
                @auth
                    <div class="containerPrice container-show-love containerLove help-show @guest notHoverHeart @endguest">
                        @if(!$worker->isLikedUBy($worker))
                            <form method="POST" action="/workerz/{{$worker->slug}}/like">
                                @csrf

                                <button type="submit" class="button-loves">
                                    <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                    <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                         alt="icone de coeur">
                                    <span>
                                        {{$worker->likes ? : 0}}</span></button>
                            </form>
                        @else

                            <form method="POST" action="/workerz/{{$worker->slug}}/like">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-loves">
                                    <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                         alt="icone de coeur">
                                    <span>
                                        {{$worker->likes ? : 0}}</span></button>
                            </form>
                        @endif
                    </div>

                @else
                    <a href="{{route('login')}}">
                        <div class="containerPrice containerLove hepling helping-like help-show">

                            <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                            <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                 alt="icone de coeur">
                            <p>
                                {{$worker->likes? : 0}}</p>
                            <span> Il faut être connecter pour aimer l'annonce</span>
                        </div>
                    </a>
                @endauth
            </div>
            <div class="container-picture-ads">
                @if($worker->picture)
                    <img src="{{ $worker->pic }}" alt="photo de profil de {{ucfirst($worker->name)}}"/>
                @else
                    <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                @endif
            </div>
            <div class="container-infos-perso-ads">
                <h3 aria-level="3">
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
                            Ouvert le : @foreach($worker->startDate as $ws){{substr($ws->name, 0, 3)}}{{ ($loop->last ? '' : ', ') }}@endforeach
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
            @foreach($randomUsers as $ra)
                <section class="container-infos-perso-ads container-ad-random">
                    <div class="container_title__province">
                        <div class="container-love-show">
                            @auth
                                <div class="containerPrice container-show-love containerLove help-show @guest notHoverHeart @endguest">
                                    @if(!$ra->isLikedUBy($ra))
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
                                    <div class="containerPrice containerLove hepling helping-like help-show">

                                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="icone de coeur">
                                        <p>
                                            {{$ra->likes? : 0}}</p>
                                        <span> Il faut être connecter pour aimer l'annonce</span>
                                    </div>
                                </a>
                            @endauth
                        </div>
                        <div class="container-picture-ads">
                            @if($ra->picture)
                                <img src="{{ $ra->pic }}"
                                     alt="photo de profil de {{$ra->name}}"/>
                            @else
                                <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                            @endif
                        </div>
                        <div>
                            <h3 aria-level="3">
                                {{ucfirst($ra->name)}}
                                {{ucfirst($ra->surname)}}
                            </h3>
                        </div>
                        <div class="container-infos-ads-randomm">

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
                    <a href="/workerz/{{$ra->slug}}" class="btn-ads button-personnal-announcement">
                    </a>
                </section>
            @endforeach
        </div>
    </section>
@endsection
