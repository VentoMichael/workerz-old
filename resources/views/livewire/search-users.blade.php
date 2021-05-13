<div>
    <div class="container-form-search">
        <form action="{{route('home.index')}}" method="get">
            <input type="search" spellcheck="false" placeholder="Rechercher un indépendant" wire:model="search" name="search" class="search-home">
            <input type="submit" class="submit-category-home" value="Recherchez">
        </form>
    </div>
    @if($search !== "")
        <div wire:loading.class="load" class="container-boxes">
            <div class="container-users-box">
                <ul>
                    <li class="container-all-users-boxes">
                        @forelse($workerz as $worker)
                            <a class="link-container-infos-user-box" href="/workerz/{{$worker->slug}}">
                                <ul class="container-infos-user-box">
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

                                        {{$worker->name}}
                                    </li>
                                </ul>
                            </a>
                        @empty
                            <ul wire:loading.class="load" class="container-infos-user-box-no-data">
                                <li>
                                    <img class="user-img-box" src="{{asset('svg/not-found.svg')}}" alt="Pictogramme d'une ampoule">
                                </li>
                                <li>
                                    Je n'ai trouvé aucun indépendant avec ce nom. <a style="text-decoration: underline;"
                                        href="{{route('workerz')}}">Je vais voir tous les indépendants</a>
                                </li>
                            </ul>
                        @endforelse
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
