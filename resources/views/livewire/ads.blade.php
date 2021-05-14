<div id="adsLink">
    <div class="container-home container-search">
        <form {{route('announcements')}} aria-label="Recherche d'annonce" role="search" method="get" class="formSearchAd">
            <label for="search" class="hidden">Recherche d'annonces</label>
            <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                   placeholder="Rechercher par nom"
                   class="search-announcement search-home">
            <noscript>
                <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
            </noscript>
        </form>
    </div>
    <section class="container-home container-announcements">
        <h2 class="hidden" aria-level="2">
            Toutes les annonces
        </h2>
        <div class="container-all-announcement show-content">
            @forelse($announcements as $announcement)
                <section class="container-announcement" wire:loading.class="load" itemtype="https://schema.org/Thing" itemscope>
                    <div class="container-infos-announcement">
                        <div class="container-love-show">
                            @auth
                                <div
                                    class="containerPrice container-show-love like-users-connected like-index containerLove help-show @guest notHoverHeart @endguest">
                                    @if(!$announcement->isLikedBy($user))
                                        <form method="POST" title="Mettre un j'aime à {{$announcement->title}}" aria-label="Mettre un j'aime à {{$announcement->title}}" action="/announcements/{{$announcement->slug}}/like">
                                            @csrf

                                            <button type="submit" class="button-loves">
                                                <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                     alt="icone de coeur">
                                                <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                                     alt="icone de coeur">
                                                <span>
                                        {{$announcement->likes ? : 0}}</span></button>
                                        </form>
                                    @else

                                        <form method="POST" title="Enlever le j'aime donner à {{$announcement->title}}" aria-label="Enlever le j'aime donner à {{$announcement->title}}" action="/announcements/{{$announcement->slug}}/like">
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
                                <a href="{{route('login')}}" title="Il faut se connecter pour mettre un j'aime à {{$announcement->title}}">
                                    <div class="containerPrice containerLove like-index hepling helping-like help-show">

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

                        <div class="containerPrice">
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro"> <span>Max: {{$announcement->pricemax}}€</span>
                        </div>
                        <div class="container-image-announcement">
                            @if($announcement->picture)
                                <img itemprop="image" src="{{ $announcement->picture }}"
                                     alt="image de profil de {{$announcement->title}}"/>
                            @else
                                <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                            @endif
                        </div>
                        <h3 aria-level="3" itemprop="name">
                            {{ucfirst($announcement->title)}}
                        </h3>
                        <p class="paragraph-ann" itemprop="description">
                            {{ucfirst($announcement->description)}}
                        </p>
                        <div class="container-infos">
                            <div class="container-info-announcement">
                                <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                                <div class="containerJobAds">
                                    <p>
                                        {{ucfirst($announcement->job)}}
                                    </p>
                                    @if($announcement->categoryAds->count())
                                        <p class="categoryJob">
                                            @foreach($announcement->categoryAds as $a)({{$a->name}}{{ ($loop->last ? '' : ', ') }})@endforeach
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="container-info-announcement" itemtype="https://schema.org/PostalAddress" itemscope>
                                <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                                <div>
                                    @if($announcement->adress)
                                        <p itemprop="streetAddress">{{$announcement->adress}}</p>
                                    @endif
                                    <p class="categoryJob" itemprop="addressRegion">({{ucfirst($announcement->province->name)}})</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/announcements/{{$announcement->slug}}" class="button-personnal-announcement">
                        Aller voir {{$announcement->title}}
                    </a>
                </section>
            @empty
                <section wire:loading.class="load" class="container-announcement container-empty-ad">
                    <div class="container-infos-announcement">
                        <img src="{{asset('svg/not-found.svg')}}" alt="Pictogramme d'une ampoule">
                        <h3 aria-level="3">
                            Aucune annonces trouvé avec cette recherche
                        </h3>
                        <p class="containerAllText" style="margin-top: 10px;">
                            Oops, je n'ai rien trouvé ! Essayer une autre recherche ou <a
                                style="text-decoration: underline;"
                                href="{{route('announcements').'#adsLink'}}">rafraichissez la page</a>
                        </p>
                    </div>
                </section>
            @endforelse
            {{ $announcements->links() }}
        </div>

        <div class="container-filters">
            <form aria-label="Filtrage d'annonces" {{route('announcements')}} method="get">
                <section>
                    <h2 aria-level="2">
                        Filtres
                    </h2>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            Catégories
                        </h3>
                        <ul class="list-categories">
                            <fieldset>
                                <legend class="hidden">Catégories</legend>
                                @foreach($categories as $category)
                                    @if($category->announcements_count !=0)
                                        <li>
                                            <input class="inp-cbx hidden" id="category{{$category->id}}"
                                                   name="category[]"
                                                   type="checkbox" value="{{$category->id}}"/>
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
                                @endforeach</fieldset>
                        </ul>
                    </section>
                    <section class="container-filter-categories">
                        <h3 aria-level="3">
                            Régions
                        </h3>
                        <ul class="list-categories">
                            <fieldset>
                                <legend class="hidden">Régions</legend>
                                @foreach($regions as $region)
                                    @if($region->announcements_count !=0)
                                        <li>

                                            <input wire:model="regionSeleted" class="hidden inp-cbx" id="region{{$region->id}}"
                                                   name="regionSeleted[]"
                                                   type="checkbox"/>
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
                                @endforeach</fieldset>
                        </ul>
                    </section>
                    <noscript>
                        <button>
                            Appliquer les filtres
                        </button>
                    </noscript>
                </section>
            </form>
        </div>
    </section>
</div>
