<div class="container-home container-search" id="workerzLink">
    <div class="container-search">
        <form action="#" method="get" class="formSearchAd">
            <label for="search" class="hidden">Recherche d'annonces</label>
            <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                   placeholder="Rechercher par nom"
                   class="search-announcement search-home">
            <noscript>
                <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
            </noscript>
        </form>
    </div>
    <section class="container-announcements show-content">
        <h2 class="hidden" aria-level="2">
            Toutes les annonces
        </h2>
        <div class="container-all-announcement show-content">
            @forelse($workerz as $worker)
                <section class="container-announcement" wire:loading.class="load">
                    <div class="container-infos-announcement">
                        <div class="container-love-show">
                            @auth
                                <div
                                    class="containerPrice container-show-love containerLove like-index help-show @guest notHoverHeart @endguest">
                                    @if(!$worker->isLikedUBy($worker))
                                        <form method="POST" action="/workerz/{{$worker->slug}}/like">
                                            @csrf

                                            <button type="submit" class="button-loves">
                                                <img class="heart" src="{{asset('svg/heart.svg')}}"
                                                     alt="icone de coeur">
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
                                    <div class="containerPrice containerLove like-users like-index hepling helping-like help-show">

                                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="icone de coeur">
                                        <p>
                                            {{$worker->likes? : 0}}</p>
                                        <span> Il faut être connecter pour aimer l'entreprise</span>
                                    </div>
                                </a>
                            @endauth
                        </div>
                        <div class="containerPrice">
                            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                            <span>{{$worker->pricemax}} €/h</span>
                        </div>
                        <div class="container-image-announcement">
                            @if($worker->picture)
                                <img src="{{ $worker->picture }}"
                                     alt="image de profil de {{$worker->name}} @if($worker->surname) {{$worker->surname}} @endif">
                            @else
                                <img src="{{asset('svg/market.svg')}}" alt="icone d'un magasin">
                            @endif
                        </div>
                        <h3 aria-level="3">
                            {{ucfirst($worker->name)}}
                        </h3>
                        <p class="paragraph-ann">
                            {{ucfirst($worker->description)}}
                        </p>
                        <div class="container-infos">

                            <div class="container-info-announcement">
                                <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                                <div class="containerJobAds">
                                    <p>{{ucfirst($worker->job)}}</p>
                                    @if($worker->categoryUser->count())
                                        <p class="categoryJob">
                                            (@foreach($worker->categoryUser as $w){{ucfirst($w->name)}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @if($worker->adresses->count())
                                <div class="container-info-announcement">
                                    <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                                    <div class="container-location">
                                        <p>{{ucfirst($worker->adresses->first()->postal_adress)}}</p>
                                        <p class="categoryJob">({{ucfirst($worker->adresses->first()->province->name)}}
                                            )</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <a href="/workerz/{{$worker->slug}}" class="button-personnal-announcement">
                    </a>
                </section>
            @empty
                <section wire:loading.class="load" class="container-announcement container-empty-ad">
                    <div class="container-infos-announcement">
                        <img src="{{asset('svg/not-found.svg')}}" alt="Pictogramme d'une ampoule">
                        <h3 aria-level="3">
                            Aucun indépendant trouvé avec cette recherche
                        </h3>
                        <p class="containerAllText" style="margin-top: 10px;">
                            Oops, je n'ai rien trouvé ! Essayer une autre recherche ou <a style="text-decoration: underline;"
                                                                                          href="{{route('workerz').'#workerzLink'}}">rafraichissez la page</a>
                        </p>
                    </div>
                </section>
            @endforelse
            {{ $workerz->links() }}
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
                                    @if($category->users_count !=0)
                                        <li>
                                            <input class="inp-cbx" id="category{{$category->id}}"
                                                   name="category[]"
                                                   type="checkbox" value="{{$category->id}}" style="display: none;"/>
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
                                    @if($region->users_count !=0)
                                        <li>

                                            <input wire:model="regionSeleted" class="inp-cbx" id="region{{$region->id}}"
                                                   name="regionSeleted[]"
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
