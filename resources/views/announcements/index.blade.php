@extends('layouts.app')
@section('content')
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
    <section>
        <h2 class="hidden" aria-level="2">
            Toutes les annonces
        </h2>
        <div class="container-all-announcement container-home show-content">
            <section class="container-announcement" id="showmgs">
                <div class="container-infos-announcement">
                    <div class="containerPrice">
                        <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">Max: 5000 €
                    </div>
                    <div class="container-image-announcement">
                        <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                    </div>
                    <h3>
                        Je recherche un coach en nutrition
                    </h3>
                    <p class="paragraph-ann">
                        @php
                            $str = 'fefzefzefjnezjfnzkejnfkjzenfzefefzefzefjnezjfnzkejnfkjzenfzefefzefzefjnezjfnzkejnfkjzenfzefefzefzefjnezjfnzkejnfkjzenfzefefzefzefjnezjfnzkejnfkjzenfze';

                        @endphp
                        @if (strlen($str) > 50 && !isset($_GET['showmore']))
                            @php
                                $str = substr($str, 0, 50) . '...';
                            @endphp
                            {{$str}}
                        @else
                            {{$str}}
                        @endif

                    </p>
                    @if (strlen($str) > 50)
                        @if(!isset($_GET['showmore']))
                        <form action="#" method="get">
                            <button class="button-more-text" name="showmore">

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
            <section class="container-announcement">
                <div class="container-infos-announcement">
                    <h3>
                        Je recherche un coach en nutrition
                    </h3>
                    @php $string = "Je n'arrive pas à faire des séances de sport, il faut m'aider, même devant la" @endphp
                    <p class="paragraph-ann">
                        @php echo $string @endphp
                    </p>

                    @if(strlen($string) > 30)
                        <p class="showmore">
                            <a class="button-more-text">

                            </a>
                        </p>
                    @endif
                    <div class="container-infos">
                        <div class="container-info-announcement">
                            <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                            <p>Lorem ipsum dolor sit amet</p>
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
        </div>
    </section>
@endsection
