
<div>
<div class="container-home container-search">
    <form action="#" method="get" class="formSearchAd">
        <label for="search" class="hidden">Recherche d'annonces</label>
        <input type="text" name="search" id="search" wire:model="search" placeholder="Rechercher par nom"
               class="search-announcement search-home">
        <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
    </form>
</div>
<section class="container-home container-announcements" id="adsLink">
    <h2 class="hidden" aria-level="2">
        Toutes les annonces
    </h2>
    <div class="container-all-announcement show-content" wire:loading.class="load">
        @forelse($announcements as $announcement)
            <section class="container-announcement">
                <div class="container-infos-announcement">
                    <div class="container-love-show">
                        @auth
                            <div
                                class="containerPrice container-show-love like-index containerLove help-show @guest notHoverHeart @endguest">
                                @if(!$announcement->isLikedBy($user))
                                    <form method="POST" action="/workerz/{{$announcement->slug}}/like">
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
                        <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">Max: {{$announcement->pricemax}}€
                    </div>
                    <div class="container-image-announcement">
                        @if($announcement->picture)
                            <img src="{{ $announcement->picture }}"
                                 alt="image de profil de {{$announcement->name}}"/>
                        @else
                            <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                        @endif
                    </div>
                    <h3 aria-level="3">
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
                                @if($announcement->categoryAds->count())
                                    <p class="categoryJob">
                                        (@foreach($announcement->categoryAds as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
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
                <a href="/announcements/{{$announcement->slug}}" class="button-personnal-announcement">
                </a>
            </section>
        @empty
            <section wire:loading.class="load" class="container-announcement container-empty-ad">
                <div class="container-infos-announcement">
                    <img src="{{asset('svg/idea.svg')}}" alt="Pictogramme d'une ampoule">
                    <h3 aria-level="3">
                        Aucune annonces trouvé avec cette recherche
                    </h3>
                    <p class="containerAllText" style="margin-top: 10px;">
                        Oops, je n'ai rien trouvé ! Essayer une autre recherche ou <a
                            href="{{route('announcements').'#adsLink'}}">rafraichissez la page</a>
                    </p>
                </div>
            </section>
        @endforelse
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
</div>
