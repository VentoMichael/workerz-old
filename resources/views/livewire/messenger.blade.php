<div class="container-search-ads">
    <form action="{{$firstUser->slug.request('search')}}" aria-label="Rechercher mes annonces" role="search"
          method="get" class="formSearchAd">
        <label for="search" class="hidden">Rechercher mes annonces</label>
        <input type="text" name="search" value="{{request('search')}}" id="search"
               wire:model="search"
               placeholder="Rechercher par nom"
               class="search-announcement search-home search-ads">
        <input type="hidden" name="firstAd" value="{{$firstUser->slug}}">
        <noscript>
            <button type="submit" class="button-cta submit-category-home submit-ad">Recherchez</button>
        </noscript>
    </form>
    <div class="container-announcments-dashboard" wire:loading.class="load">
        @forelse($users as $user)
            <a class="{{ Request::is('dashboard/messages/'.$user->slug) || Request::is('dashboard/messages/'.$user->slug.'/*') ? "container-announcements-active" : "" }} container-announcements"
               href="{{route('dashboard.messagesShow',[$user->slug])}}"
               aria-current="{{ Request::is('dashboard/messages/*') ? "page" : "" }}">
                <section>
                    <img src="{{asset('svg/messenger.svg')}}" alt="icone de messages">
                    <div>
                        <h3 aria-level="3">
                            {{$user->name}}
                        </h3>
                    </div>
                </section>
            </a>
        @empty
            <div class="container-announcements"
            >
                <section>
                    <img src="{{asset('svg/market.svg')}}" alt="icone d'annonce">

                    <div>
                        <h3 aria-level="3">
                            Aucune conversation trouvée ...
                        </h3>
                        <a class="button-cta" href="{{route('workerz')}}">
                            Je vais voir les differentes entreprises
                        </a>
                    </div>
                </section>
            </div>
        @endforelse
    </div>
</div>
