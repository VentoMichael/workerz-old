<div class="container-search-ads">
    <form action="{{route('dashboard.ads.show',['announcement' => $firstAd->slug])}}" aria-label="Rechercher mes annonces" role="search"
          method="get" class="formSearchAd">
        <label for="search" class="hidden">Rechercher mes annonces</label>
        <input type="text" name="search" value="{{request('search')}}" id="search"
               wire:model="search"
               placeholder="Rechercher par titre d'annonce"
               class="search-announcement search-home search-ads">
        <input type="hidden" name="firstAd" value="{{$firstAd->slug}}">
        <noscript>
            <button type="submit" class="button-cta submit-category-home submit-ad">Recherchez</button>
        </noscript>
    </form>
    <div class="container-announcments-dashboard" wire:loading.class="load">
        @forelse($announcements as $announcement)
            <a class="{{ Request::is('dashboard/ads/'.$announcement->slug) || Request::is('dashboard/ads/'.$announcement->slug.'/*') ? "container-announcements-active" : "" }} container-announcements"
               href="{{asset('dashboard/ads/'.$announcement->slug)}}"
               aria-current="{{ Request::is('dashboard/ads/*') ? "page" : "" }}">
                <section>
                    <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonce">
                    <div>
                        <h3 aria-level="3">
                            {{$announcement->title}}
                        </h3>
                        <div class="container-counter-views">
                        <p class="view-counter">{{ $announcement->view_count }} @if($announcement->view_count >1 )vues @else vue @endif</p>
                        <p class="view-like">{{$announcement->likes ? : 0}} @if($announcement->likes == null || $announcement->likes <= 1)j'aime @else j'aimes @endif</p>
                        </div>
                    </div>
                </section>
            </a>
        @empty
            <div class="container-announcements"
            >
                <section>
                    <img src="{{asset('svg/ad.svg')}}" alt="icone d'annonce">

                    <div>
                        <h3 aria-level="3">
                            Aucune annonce trouvée ...
                        </h3>
                        <a class="button-cta" href="{{route('announcements.plans')}}">
                            J'en poste une
                        </a>
                    </div>
                </section>
            </div>
        @endforelse
    </div>
</div>
