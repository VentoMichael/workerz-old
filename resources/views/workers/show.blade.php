@extends('layouts.app')
@section('content')
@if(Session::has('loveOk'))
<div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
    <p>{!! session('loveOk') !!}</p>
    <span class="crossHide" id="crossHide">&times;</span>
</div>
@endif
@if(Session::has('loveNotOk'))
<div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
    <p>{!!session('loveNotOk')!!}</p>
    <span class="crossHide" id="crossHide">&times;</span>
</div>
@endif
<section class="container-home margin">
    <div class="container-home_image container-home-create container-home-page">
        <div>
            <div class="container-home-text">
                <h2 aria-level="2">
                    Vous avez fait le bon choix&nbsp;!
                </h2>
                <p>Prenez contact avec {{ucfirst($worker->name)}}, soit par <a
                            href="mailto:{{$worker->email}}">mail</a> soit par <a
                            href="tel:{{$worker->phones()->first()->number}}">téléphone</a>. Cette entreprise s'enverra
                    ravir&nbsp;!</p>
            </div>
        </div>
        <div class="container-svg">
            <img src="{{asset('svg/Great_idea_Monochromatic.svg')}}"
                 alt="Personne choissisant la catégorie de métier">
        </div>
    </div>
</section>
<section class="container-categories-home margin" @if($randomUsers->count() < 1) style="margin-bottom:50px;" @endif>
    <div class="container-categories-text-home">
        @if($worker->catchPhrase)
        <h2 aria-level="2">
            {{ $worker->catchPhrase }}
        </h2>
        @else
        <h2 aria-level="2">
            Une entreprise {{$randomPhrasing->name}}
        </h2>
        @endif
    </div>
    <section class="container-personnal-ads show-content container-worker">
        <div class="container-love-show">
            @auth
            <div
                    class="containerPrice container-show-love containerLove help-show like-workerz @guest notHoverHeart @endguest">
                @if(!$worker->isLikedUBy($worker))
                <form method="POST" title="Mettre un j'aime à {{$worker->name}}"
                      aria-label="Mettre un j'aime à {{$worker->name}}"
                      action="/workers/{{$worker->slug}}/like">
                    @csrf

                    <button type="submit" class="button-loves">
                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                             alt="icone de coeur">
                        <span>
                                        {{$worker->likes ? : 0}}</span></button>
                </form>
                @else
                <form method="POST" title="Enlever le j'aime donner à {{$worker->name}}"
                      aria-label="Enlever le j'aime donner à {{$worker->name}}"
                      action="/workers/{{$worker->slug}}/like">
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
            <a href="{{route('login')}}" title="Il faut se connecté pour mettre un j'aime à {{$worker->name}}">
                <div class="containerPrice container-love-notAuth containerLove like-users hepling helping-like help-show">

                    <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                    <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                         alt="icone de coeur">
                    <p>
                        {{$worker->likes? : 0}}</p>
                    <span> Il faut être connecté pour aimer l'entreprise</span>
                </div>
            </a>
            @endauth
        </div>
        <div class="container-picture-ads">
            @if($worker->picture)
            <div itemprop="logo">
                <img src="{{ asset($worker->picture) }}" alt="photo de profil de {{ucfirst($worker->name)}}"/>
            </div>
            @else
            <div itemprop="logo">
                <img class="undefindLogo" src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
            </div>
            @endif
            <div class="container-socials-media">
                @if($worker->facebook)
                <div class="social-media">
                    <a href="{{$worker->facebook}}" class="iconFacebook">
                        Lien Facebook
                    </a>
                </div>
                @endif
                @if($worker->instagram)
                <div class="social-media">
                    <a href="{{$worker->instagram}}" class="iconInstagram">
                        Lien Instagram
                    </a>
                </div>
                @endif
                @if($worker->linkedin)
                <div class="social-media">
                    <a href="{{$worker->linkedin}}" class="iconLinkedin">
                        Lien Linkedin
                    </a>
                </div>
                @endif
                @if($worker->twitter)
                <div class="social-media">
                    <a href="{{$worker->twitter}}" class="iconTwitter">
                        Lien Twitter
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="container-infos-perso-ads" itemscope
             itemtype="https://schema.org/Person">
            <h3 aria-level="3" itemprop="givenName">
                {{ucfirst($worker->name)}}
            </h3>
            <p>
                {{ucfirst($worker->description)}}
            </p>
            <section class="container-perso-infos container-six-category-home container-show-boxes-ads">
                <h4 aria-level="4" class="hidden">Information de contact</h4>
                @foreach($worker->phones as $up)
                @if($up->number !== null)
                <div>
                    <img src="{{asset('svg/phone.svg')}}" alt="icone de téléphone">
                    <a itemprop="telephone" href="tel:{{$up->number}}">{{$up->number}}</a>
                </div>
                @endif
                @endforeach
                @if($worker->possibility_job == 'yes')
                <div>
                    <img src="{{asset('svg/question-signe-en-cercles.svg')}}"
                         alt="icone de question pour la posibilité de job">
                    <span>{{ucfirst($worker->name)}} ont des offres d'emplois</span>
                </div>
                @endif
                @if($worker->possibility_job == 'no')
                <div>
                    <img src="{{asset('svg/question-signe-en-cercles.svg')}}"
                         alt="icone de question pour la posibilité de job">
                    <span>{{ucfirst($worker->name)}} n'ont pour le moment, pas d'offres d'emplois</span>
                </div>
                @endif
                <div>
                    <img src="{{asset('svg/envelope.svg')}}" alt="icone de mail">
                    <a itemprop="email" href="mailto:{{$worker->email}}">{{$worker->email}}</a>
                </div>


                @if($worker->startDate->count())
                <div>
                    <img src="{{asset('svg/calendar.svg')}}" alt="icone de calendrier">
                    <span>
                            Ouvert le : @foreach($worker->startDate as $ws){{substr($ws->name, 0, 3)}}{{ ($loop->last ? '' : ', ') }}@endforeach
                        </span>
                </div>
                @endif
                <div>
                    <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                    <span class="job-cat-ads">
                        <span>{{ucfirst($worker->job)}}</span>
                        @if($worker->categoryUser->count())
                                <span class="categoryJob" itemprop="jobTitle">
                                (@foreach($worker->categoryUser as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                            </span>
                            @endif
                        </span>
                </div>
                @if($worker->adresses->count())
                @foreach($worker->adresses as $a)
            @if($a->postal_adress !== null)
                <div class="container-info-announcement container-infos-position">
                    <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                    <div class="container-location" itemprop="address">
                        <span>{{ucfirst($a->postal_adress)}}</span>
                        <span class="categoryJob">({{ucfirst($a->province->name)}})</span>
                    </div>
                </div>
                @endif
                @endforeach
                @endif
                @if($worker->pricemax)
                <div itemtype="https://schema.org/PriceSpecification" itemscope>
                    <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                    <span itemprop="minPrice">Un minimum de {{$worker->pricemax}}€/h</span>
                </div>
                @endif
                @if(auth()->id() !== $worker->id)
                @auth
                <form action="{{route('messages.post',[$worker->slug])}}" method="POST"
                      class="formsendmsg button-workerz">
                    @csrf
                    <input type="hidden" name="from_id" id="from_id" value="{{auth()->user()->id}}">
                    <input type="hidden" name="to_id" id="to_id" value="{{$worker->id}}">
                    <input type="hidden" name="slug" id="slug" value="{{$worker->slug}}">
                    <button type="submit" class="button-cta button-msg" name="talkTo">
                        Parler à l'entreprise
                    </button>
                </form>
                @else
                <a class="formsenmsg-show-view-Notauth formsendmsg button-cta button-msg" style="text-align: center"
                   href="{{route('login')}}"
                   title="Il faut se connecté pour parler avec {{$worker->name}}">Il faut être connecté pour parler avec
                    l'entreprise
                </a>
                @endauth
                @endif
            </section>
        </div>
        @if($worker->website)
        <a class="container-website" href="{{$worker->website}}">
            <div itemscope itemtype="https://schema.org/ServiceChannel">
                <img src="{{asset('svg/globe.svg')}}" alt="icone de site internet">

                <span itemprop="serviceUrl">Site internet</span>
            </div>
        </a>
        @else
        @if($worker->facebook)
        <a class="container-website container-fcb" href="{{$worker->facebook}}">
            <div>
                <img src="{{asset('svg/facebook-w.svg')}}" alt="icone de facebook">
                <span itemprop="serviceUrl">Lien Facebook</span>
            </div>
        </a>
        @endif
        @endif

    </section>
</section>
@if($randomUsers->count() > 0)
<section class="container-categories-home margin show-content container-adss-random">
    <div class="container-title-ads">
        <h2 aria-level="2">
            Ca pourrait vous intéresser
        </h2>
    </div>
    <div class="container-ads-random">
        @foreach($randomUsers as $ra)
        <section class="container-infos-perso-ads container-ad-random" itemscope
                 itemtype="https://schema.org/Person">
            <div class="container_title__province">
                <div class="container-love-show">
                    @auth
                    <div
                            class="containerPrice container-show-love like-ads containerLove help-show @guest notHoverHeart @endguest">
                        @if(!$ra->isLikedUBy($ra))
                        <form method="POST" title="Mettre un j'aime à {{$worker->name}}"
                              aria-label="Mettre un j'aime à {{$worker->name}}"
                              action="/workers/{{$ra->slug}}/like">
                            @csrf

                            <button type="submit" class="button-loves">
                                <img class="heart" src="{{asset('svg/heart.svg')}}"
                                     alt="icone de coeur">
                                <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                     alt="icone de coeur">
                                <span>
                                        {{$ra->likes ? : 0}}</span></button>
                        </form>
                        @else

                        <form method="POST" title="Enlever le j'aime donner à {{$worker->name}}"
                              aria-label="Enlever le j'aime donner à {{$worker->name}}"
                              action="/workers/{{$ra->slug}}/like">
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
                    <a href="{{route('login')}}"
                       title="Il faut se connecté pour mettre un j'aime à {{$worker->name}}">
                        <div
                                class="containerPrice containerLove like-users like-ads hepling helping-like help-show">

                            <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                            <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                 alt="icone de coeur">
                            <p>
                                {{$ra->likes? : 0}}</p>
                            <span> Il faut être connecté pour aimer l'entreprise</span>
                        </div>
                    </a>
                    @endauth
                </div>
                <div class="container-picture-ads container-profil-img">
                    @if($ra->picture)
                    <img src="{{ asset($ra->picture) }}"
                         alt="photo de profil de {{$ra->name}}"/>
                    @else
                    <img src="{{ asset('svg/ad.svg') }}" alt="icone d'annonces">
                    @endif
                </div>
                <div itemprop="givenName">
                    <h3 aria-level="3">
                        {{ucfirst($ra->name)}}
                        {{ucfirst($ra->surname)}}
                    </h3>
                </div>
                <div class="container-infos-ads-randomm">

                    <div class="container-position-ads">
                        <img width="40px" height="40px" src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
                        <span class="job-cat-ads" itemprop="jobTitle">
                                    <p>{{ucfirst($ra->job)}}</p>
                                    @if($ra->categoryUser->count())
                                        <p class="categoryJob">
                                            (@foreach($ra->categoryUser as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                        </p>
                                    @endif
                                </span>
                    </div>
                    @if($ra->adresses->count())
                    <div class="container-info-announcement">
                        <img width="40px" height="40px" src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                        <div class="container-location" itemprop="address">
                            <p>{{ucfirst($ra->adresses->first()->postal_adress)}}</p>
                            <p class="categoryJob">({{ucfirst($ra->adresses->first()->province->name)}})</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <a href="/workers/{{$ra->slug}}" class="btn-ads button-personnal-announcement">
                Aller voir {{$ra->name}}
            </a>
        </section>
        @endforeach
    </div>
</section>
@endif
@endsection
