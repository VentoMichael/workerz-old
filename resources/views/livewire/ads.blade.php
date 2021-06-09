
<div id="adsLink">
    @if(request('search') && count($announcements) === 0 && !$newsletterValidated || $search && count($announcements) === 0 && !$newsletterValidated)
        @include('partials.newsletter')
    @endif
    <div class="container-home container-search hideForNewsletter">
        @if($helpText !== '')
        <div class="helpSearch">
        <span>Il faut 2 caractères au minimum</span>
        </div>
        @endif
        <form action="{{route('announcements')}}" @if($helpText !== '') style="margin-top:80px;" @endif aria-label="Recherche d'annonce" role="search" method="get"
              class="formSearchAd">
            <label for="search" class="hidden">Recherche d'annonces</label>
            <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                   placeholder="Quel métier recherchez-vous ?"
                   class="search-announcement search-home">
            <noscript>
                <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
            </noscript>
        </form>
    </div>
    <section class="container-home container-announcements hideForNewsletter">
        <h2 class="hidden" aria-level="2">
            Toutes les annonces
        </h2>
        <div class="container-all-announcement show-content @if($announcements->count() < 1)noAds @endif">
            @forelse($announcements as $announcement)
                <section class="container-announcement" wire:loading.class="load" itemtype="https://schema.org/Thing"
                         itemscope>
                    <div class="container-infos-announcement">
                        <div class="container-love-show">
                            @auth
                                <div
                                    class="containerPrice container-show-love like-users-connected like-index containerLove help-show @guest notHoverHeart @endguest">
                                    @if(!$announcement->isLikedBy($user))
                                        <form method="POST" title="Mettre un j'aime à {{$announcement->title}}"
                                              aria-label="Mettre un j'aime à {{$announcement->title}}"
                                              action="/announcements/{{$announcement->slug}}/like">
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

                                        <form method="POST" title="Enlever le j'aime donner à {{$announcement->title}}"
                                              aria-label="Enlever le j'aime donner à {{$announcement->title}}"
                                              action="/announcements/{{$announcement->slug}}/like">
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
                                <a href="{{route('login')}}"
                                   title="Il faut se connecté pour mettre un j'aime à {{$announcement->title}}">
                                    <div class="containerPrice containerLove like-index hepling helping-like help-show">

                                        <img class="heart" src="{{asset('svg/heart.svg')}}" alt="icone de coeur">
                                        <img class="heartFul" src="{{asset('svg/heartFul.svg')}}"
                                             alt="icone de coeur">
                                        <p>
                                            {{$announcement->likes? : 0}}</p>
                                        <span> Il faut être connecté pour aimer l'annonce</span>
                                    </div>
                                </a>
                            @endauth
                        </div>
                        @if($announcement->pricemax)
                            <div class="containerPrice">
                                <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro"><span>Max: {{$announcement->pricemax}}€</span>
                            </div>
                        @endif
                        <div class="container-image-announcement container-profil-img">
                            @if($announcement->picture)
                                <img itemprop="image" src="{{ $announcement->picture }}"
                                     alt="image de profil de {{$announcement->title}}"/>
                            @else
                                <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                            @endif
                        </div>
                        <h3 aria-level="3" itemprop="name" id="ad{{$announcement->id}}">
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
                                            (@foreach($announcement->categoryAds as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="container-info-announcement" itemtype="https://schema.org/PostalAddress"
                                 itemscope>
                                <img src="{{asset('svg/placeholder.svg')}}" alt="icone de localité">
                                <div>
                                    @if($announcement->adress)
                                        <p itemprop="streetAddress">{{$announcement->adress}}</p>
                                    @endif
                                    <p class="categoryJob" itemprop="addressRegion">
                                        ({{ucfirst($announcement->province->name)}})</p>
                                </div>
                            </div>
                        </div>
                    </div>
                                        @if(auth()->id() !== $announcement->user_id)

                    @auth

                        @if($announcement)
                            <form action="{{route('messages.post',[$announcement->user->slug])}}" method="POST"
                                  class="formsendmsg formsenmsg-show-view">
                                @csrf
                                <input type="hidden" name="from_id" id="from_id{{$loop->index}}"
                                       value="{{auth()->user()->id}}">
                                <input type="hidden" name="to_id" id="to_id{{$loop->index}}"
                                       value="{{$announcement->user->id}}">
                                <input type="hidden" name="slug" id="slug{{$loop->index}}"
                                       value="{{$announcement->user->slug}}">
                                <button type="submit" class="button-cta button-msg" name="talkTo">
                                    Parler avec {{ucfirst($announcement->user->name)}} {{ucfirst($announcement->user->surname)}}
                                </button>
                            </form>
                        @endif
                    @else
                        <a class="formsendmsg formsenmsg-show-view-Notauth button-cta formsenmsg-show-view"
                           style="text-align: center"
                           href="{{route('login')}}"
                           title="Il faut se connecté pour parler avec le detenteur de l'annonce">Il faut être
                            connecté
                            pour parler avec la personne ayant poster l'annonce
                        </a>
                    @endauth
                    @endif
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
                            Oops, je n'ai rien trouvé @if($search)avec cette recherche <i>"{{$search}}"</i>@endif&nbsp;! Essayez une autre recherche ou <a
                                style="text-decoration: underline;"
                                href="{{route('workers').'#adsLink'}}">rafraichissez la page</a>
                        </p>
                    </div>
                </section>
            @endforelse
            {{ $announcements->links() }}
        </div>
        <div class="container-filters container-filters-workerz">
            <form aria-label="Filtrage d'annonces" action="{{route('announcements')}}" method="get">
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
                                        <li>
                                            <input
                                                @if(request('categoryAds') && in_array($category->id,request('categoryAds'))) checked
                                                @else wire:model="categoryAds" @endif class="inp-cbx hiddenCheckbox"
                                                id="categoryAds{{$category->id}}"
                                                name="categoryAds[]"
                                                type="checkbox" value="{{$category->id}}"/>
                                            <label class="cbx" for="categoryAds{{$category->id}}">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                                <span>{{$category->name}}</span>
                                            </label>
                                        </li>
                                @endforeach
                            </fieldset>
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
                                        <li>
                                            <input
                                                @if(request('province') && in_array($region->id,request('province'))) checked
                                                @else wire:model="province" @endif role="checkbox"
                                                aria-checked="false" class="hiddenCheckbox inp-cbx"
                                                id="province{{$region->id}}"
                                                name="province[]"
                                                type="checkbox" value="{{$region->id}}"/>
                                            <label class="cbx" for="province{{$region->id}}">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                                <span>{{$region->name}}</span>
                                            </label>
                                        </li>

                                @endforeach
                            </fieldset>
                        </ul>

                    </section>

                    <noscript>
                        <button type="submit" class="apply-filter-btn">
                            Appliquer les filtres
                        </button>
                    </noscript>
                </section>
            </form>
        </div>
    </section>
</div>
@section('scripts')
    @livewireScripts
    <script src="{{asset('js/newsletter.js')}}"></script>
@endsection
