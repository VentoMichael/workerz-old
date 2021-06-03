@if(request('search') && count($workerz) === 0 && !$newsletterValidated)
    @include('partials.newsletter')
@endif
<div class="container-home container-search hideForNewsletter" id="workerzLink">
    <div class="container-search">
        <form action="{{route('workerz')}}" aria-label="Recherche d'indépendants" role="search" method="get"
              class="formSearchAd">
            <label for="search" class="hidden">Recherche d'entreprises</label>
            <input type="text" name="search" value="{{request('search')}}" id="search" wire:model="search"
                   placeholder="Quelle catégorie recherchez-vous ?"
                   class="search-announcement search-home">
            <noscript>
                <input type="submit" class="submit-category-home submit-ad" value="Recherchez">
            </noscript>
        </form>
    </div>
    <section class="container-announcements show-content">
        <h2 class="hidden" aria-level="2">
            Toutes les entreprises
        </h2>
        <div class="container-all-announcement show-content @if($workerz->count() < 1) noAds @endif">
            @forelse($workerz as $worker)
                <section class="container-announcement" wire:loading.class="load" itemscope
                         itemtype="https://schema.org/Person">
                    <div class="container-infos-announcement">
                        <div class="container-love-show">
                            @auth
                                <div
                                    class="containerPrice container-show-love like-users-connected containerLove like-index help-show @guest notHoverHeart @endguest">
                                    @if(!$worker->isLikedUBy($worker))
                                        <form method="POST" title="Mettre un j'aime à {{$worker->name}}"
                                              aria-label="Mettre un j'aime à {{$worker->name}}"
                                              action="/workerz/{{$worker->slug}}/like">
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

                                        <form method="POST" title="Enlever le j'aime donner à {{$worker->name}}"
                                              aria-label="Enlever le j'aime donner à {{$worker->name}}"
                                              action="/workerz/{{$worker->slug}}/like">
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
                                <a href="{{route('login')}}"
                                   title="Il faut se connecter pour mettre un j'aime à {{$worker->name}}">
                                    <div
                                        class="containerPrice containerLove like-users like-index hepling helping-like help-show">

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
                        @if($worker->pricemax)
                            <div class="containerPrice" itemscope itemtype="https://schema.org/PriceSpecification">
                                <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
                                <span itemprop="price">{{$worker->pricemax}} €/h</span>
                            </div>
                        @endif
                        <div class="container-image-announcement">
                            @if($worker->picture)
                                <img src="{{ $worker->picture }}"
                                     alt="image de profil de {{$worker->name}} @if($worker->surname) {{$worker->surname}} @endif">
                            @else
                                <img src="{{asset('svg/market.svg')}}" alt="icone d'un magasin">
                            @endif
                        </div>
                        <h3 aria-level="3" itemprop="affiliation">
                            {{ucfirst($worker->name)}}
                        </h3>
                        <p class="paragraph-ann">
                            {{ucfirst($worker->description)}}
                        </p>
                        <div class="container-infos">
                            <div class="container-info-announcement">
                                <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette de travail">
                                <div class="containerJobAds" itemprop="jobTitle">
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
                                    <div class="container-location" itemprop="address">
                                        <p>{{ucfirst($worker->adresses->first()->postal_adress)}}</p>
                                        <p class="categoryJob">({{ucfirst($worker->adresses->first()->province->name)}}
                                            )</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @auth
                        @if($workerz)
                            <form action="{{route('messages.post',[$worker->slug])}}" method="POST"
                                  class="formsendmsg formsenmsg-show-view">
                                @csrf
                                <input type="hidden" name="from_id" id="from_id{{$worker->id}}"
                                       value="{{auth()->user()->id}}">
                                <input type="hidden" name="to_id" id="to_id{{$worker->id}}" value="{{$worker->id}}">
                                <input type="hidden" name="slug" id="slug{{$worker->id}}" value="{{$worker->slug}}">
                                <button type="submit" class="button-cta button-msg" name="talkTo">
                                    Parler avec {{$worker->name}} {{$worker->surname}}
                                </button>
                            </form>
                        @endif
                    @else
                        <a class="formsendmsg formsenmsg-show-view-Notauth button-cta button-msg"
                           href="{{route('login')}}"
                           title="Il faut se connecté pour parler avec le détenteur de l'annonce">Il faut être
                            connecté
                            pour parler avec la personne ayant posté l'annonce
                        </a>
                    @endauth
                    <a href="/workerz/{{$worker->slug}}" class="button-personnal-announcement">
                        Aller voir {{$worker->name}}
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
                            Oops, je n'ai rien trouvé avec cette recherche <i>"{{request('search')}}"</i>&nbsp;! Essayez une autre recherche ou <a
                                style="text-decoration: underline;"
                                href="{{route('workerz').'#adsLink'}}">rafraichissez la page</a>
                        </p>
                    </div>
                </section>
            @endforelse
            {{ $workerz->links() }}
        </div>
        <div class="container-filters container-filters-workerz">
            <form aria-label="Filtrage d'indépendants" action="{{route('workerz')}}" method="get">
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
                                                @if(request('categoryUser') && in_array($category->id,request('categoryUser'))) checked
                                                @else wire:model="categoryUser" @endif role="checkbox"
                                                class="hiddenCheckbox inp-cbx"
                                                name="categoryUser[]"
                                                id="categoryUser{{$category->id}}"
                                                type="checkbox" value="{{$category->id}}"/>
                                            <label class="cbx" for="categoryUser{{$category->id}}">
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
                                                @if(request('provinces') && in_array($region->id,request('provinces'))) checked
                                                @endif wire:model="provinces" role="checkbox"
                                                aria-checked="false" class="hiddenCheckbox inp-cbx"
                                                id="provinces{{$region->id}}"
                                                name="provinces[]"
                                                type="checkbox" value="{{$region->id}}"/>
                                            <label class="cbx" for="provinces{{$region->id}}">
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
                        <button class="apply-filter-btn">
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
