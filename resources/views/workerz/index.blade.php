@extends('layouts.app')
@section('content')
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
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Online research.svg')}}"
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
    <section class="container-home container-announcements show-content">
        <h2 class="hidden" aria-level="2">
            Toutes les annonces
        </h2>
        <div class="container-all-announcement">
            @for($i =0;$i <= 3; $i++)
                <section class="container-announcement" id="showmgs{{$i}}">
                    <div class="container-infos-announcement">
                        <div class="containerPrice">
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro"><span>Max: 5000 €</span>
                        </div>
                        <div class="containerPrice containerLove">
                            <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                            <img class="heartFul" src="{{asset('svg/heartFul.svg')}}" alt="icone de coeur">                             <span>100</span>
                        </div>
                        <div class="container-image-announcement">
                            <img src="{{asset('svg/market.svg')}}" alt="icone d'un magasin">
                        </div>
                        <h3>
                            Je recherche un coach en nutrition
                        </h3>
                        <p class="paragraph-ann">
                            @php
                                $str = 'fefzefzefjnezjfnzkejnfkjzefefzefzefjnezjfnzkejnfkjzefefzefzefjnezjfnzkejnfkjzefefzefzefjnezjfnzkejnfkjze';

                            @endphp
                            @if (strlen($str) > 60 && !isset($_GET['showmore'.$i]))
                                @php
                                    $str = substr($str, 0, 60) . '...';
                                @endphp
                            @endif
                            {{$str}}

                        </p>
                        @if (strlen($str) > 60)
                            @if(!isset($_GET['showmore'.$i]))
                                <form action="#showmgs{{$i}}" method="get">
                                    <button class="button-more-text" name="showmore{{$i}}">
                                    </button>
                                </form>
                            @endif
                        @endif
                        <div class="container-infos">
                            <div class="container-info-announcement">
                                <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                                <p>fezfezfLorem ipsum dolor sit amet</p>
                            </div>
                            <div class="container-info-announcement">
                                <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                                <p>Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="button-personnal-announcement">

                    </a>
                </section>
            @endfor
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
                            <li>
                                <input class="inp-cbx" id="test1" name="test1" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test1">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test1</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test2" name="test2" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test2">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test2</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test3" name="test3" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test3">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test3</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test4" name="test4" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test4">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test4</span>
                                </label>
                            </li>
                        </ul>
                    </section>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            Régions
                        </h3>
                        <ul class="list-categories">
                            <li>
                                <input class="inp-cbx" id="test1" name="test1" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test1">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test1</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test2" name="test2" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test2">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test2</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test3" name="test3" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test3">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test3</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test4" name="test4" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test4">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test4</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test1" name="test1" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test1">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test1</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test2" name="test2" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test2">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test2</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test3" name="test3" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test3">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test3</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test4" name="test4" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test4">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test4</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test1" name="test1" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test1">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test1</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test2" name="test2" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test2">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test2</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test3" name="test3" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test3">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test3</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test4" name="test4" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test4">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test4</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test1" name="test1" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test1">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test1</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test2" name="test2" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test2">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test2</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test3" name="test3" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test3">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test3</span>
                                </label>
                            </li>
                            <li>
                                <input class="inp-cbx" id="test4" name="test4" type="checkbox" style="display: none;"/>
                                <label class="cbx" for="test4">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span>test4</span>
                                </label>
                            </li>
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
