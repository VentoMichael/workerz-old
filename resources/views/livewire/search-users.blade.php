<div>
    <div class="container-form-search">
        @if($helpText !== '')
        <div class="helpSearch">
        <span>Il faut 2 caractères au minimum</span>
        </div>
        @endif
        <form aria-label="Recherche d'indépendants" @if($helpText !== '') style="margin-top:80px;" @endif role="search" action="{{route('workers')}}" method="get">
            <label for="search" class="hidden">Recherche d'indépendants</label>
            <input type="search" spellcheck="false" placeholder="Quel métier recherchez-vous ?" wire:model="search" name="search" class="search-home" id="search">
            <input type="submit" class="submit-category-home" value="Recherchez">
        </form>
    </div>
    @if($search !== "" && strlen($search) >1)
        <div wire:loading.class="load" class="container-boxes">
            <div class="container-users-box">
                <ul>
                    <li class="container-all-users-boxes">
                        @forelse($workerz as $worker)
                            <a wire:loading.class="load" class="link-container-infos-user-box" href="/workers/{{$worker->slug}}">
                                <ul class="container-infos-user-box" itemscope
                         itemtype="https://schema.org/Person">
                                    <li>
                                        @if($worker->picture)
                                            <img class="user-img-box" src="{{ $worker->picture }}"
                                                 alt="image de profil de {{$worker->name}} @if($worker->surname) {{$worker->surname}} @endif">
                                        @else
                                            <img class="user-img-box" src="{{asset('svg/market.svg')}}"
                                                 alt="icone d'un magasin">
                                        @endif
                                    </li>
                                    <li>
                                        <span itemprop="affiliation">{{$worker->name}}</span>
<p itemprop="address" class="categoryJob">{{ucfirst($worker->job)}}</p>
                                    </li>
                                </ul>
                            </a>
                        @empty
                            <ul wire:loading.class="load" class="container-infos-user-box-no-data">
                                <li>
                                    <img class="user-img-box" src="{{asset('svg/not-found.svg')}}" alt="Pictogramme d'une ampoule">
                                </li>
                                <li>
                                    <p>
                                    Je n'ai trouvé aucun indépendant avec ce métier. <a style="text-decoration: underline;"
                                        href="{{route('workers')}}">Je vais voir tous les indépendants</a></p>
                                </li>
                            </ul>
                        @endforelse
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
