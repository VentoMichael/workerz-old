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
        <div class="container-home_image container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Une annonce particulière
                    </h2>
                    <p>
                        Parmis les diverses annonces, il ne vous reste plus qu'à trouver l'annonce qui vous convient
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Information carousel_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <div class="container-home container-search">
        <form action="#" method="get" class="formSearchAd">
            <input type="search" placeholder="Rechercher par nom ou par catégorie"
                   class="search-announcement search-home">
            <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
        </form>
    </div>
    <section class="container-home container-announcements">
        <h2 class="hidden" aria-level="2">
            Toutes les annonces
        </h2>
        <div class="container-all-announcement show-content">
            @foreach($announcements as $announcement)

                <section class="container-announcement" id="showmgs{{$announcement->id}}">
                    <div class="container-infos-announcement">
                        <div class="containerPrice containerLove @guest notHoverHeart @endguest">
                            @auth
                                @if(!$announcement->isLikedBy($user))
                                    <form method="POST" action="/announcements/{{$announcement->title}}/like">
                                        @csrf

                                        <button type="submit" class="button-loves">
                                            <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                            <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                 alt="icone de coeur">
                                            <span>
                                        {{$announcement->likes? : 0}}</span></button>
                                    </form>
                                @else
                                <form method="POST" action="/announcements/{{$announcement->title}}/like">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button-loves">
                                        <img class="heartFul heartLiked" src="{{asset('svg/heartFul.svg')}}"
                                             alt="icone de coeur">
                                        <span>
                                        {{$announcement->likes? : 0}}</span></button>
                                </form>
                                @endif

                            @else
                        </div>
                        <a href="{{route('login')}}">
                        <div class="containerPrice containerLove hepling helping-like">

                                <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                     alt="icone de coeur">
                                <p>
                                    {{$announcement->likes? : 0}}</p>
                                <span> Il faut être connecter pour aimer l'annonce</span>
                            @endauth
                        </div>
                        </a>
                        <div class="containerPrice">
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">Max: {{$announcement->pricemax}}€
                        </div>
                        <div class="container-image-announcement">
                            @if($announcement->picture)
                                <img src="{{ $announcement->picture }}"/>
                            @else
                                <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                            @endif
                        </div>
                        <h3>
                            {{ucfirst($announcement->title)}}
                        </h3>
                        <p class="paragraph-ann">
                            {{ucfirst($announcement->description)}}
                        </p>
                        <div class="container-infos">
                            <div class="container-info-announcement">
                                <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                                <div class="containerJobAds">
                                    <p>
                                        {{ucfirst($announcement->job)}}
                                    </p>
                                    @if($announcement->categories->count())
                                        <p class="categoryJob">
                                            (@foreach($announcement->categories as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="container-info-announcement">
                                <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                                <p>{{$announcement->province->name}}</p>
                            </div>
                        </div>
                    </div>
                    <a href="/announcements/{{$announcement->title}}" class="button-personnal-announcement">
                    </a>
                </section>
            @endforeach
            {{ $announcements->links() }}
        </div>

        <div class="container-filters">
            <form action="#" method="get">
                <section>
                    <h2 aria-level="2">
                        Filtres
                    </h2>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            Catégories
                        </h3>
                        <ul class="list-categories">
                            @foreach($categories as $category)
                                @if($category->announcements_count !=0)
                                    <li>
                                        <input class="inp-cbx" id="category{{$category->id}}"
                                               name="category{{$category->id}}"
                                               type="checkbox" style="display: none;"/>
                                        <label class="cbx" for="category{{$category->id}}">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                            <span>{{$category->name}}</span>
                                        </label>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </section>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            Régions
                        </h3>
                        <ul class="list-categories">
                            @foreach($regions as $region)
                                @if($region->announcements_count !=0)
                                    <li>
                                        <input class="inp-cbx" id="region{{$region->id}}" name="region{{$region->id}}"
                                               type="checkbox"
                                               style="display: none;"/>
                                        <label class="cbx" for="region{{$region->id}}">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                            <span>{{$region->name}}</span>
                                        </label>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </section>
                    <button>
                        Appliquer les filtres
                    </button>
                </section>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('js/successMsg.js')}}"></script>
@endsection
