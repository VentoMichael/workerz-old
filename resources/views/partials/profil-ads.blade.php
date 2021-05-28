<div class="container-picture-title-dashboard-ads">
    @if($announcement->catchPhrase)
        <p class="container-ads-catch_phrase-dashboard">
            {{ucfirst($announcement->catchPhrase)}}
        </p>
    @endif
    <div class="container-picture-dashboard">
        @if($announcement->picture)
            <img itemprop="image" src="{{ asset($announcement->picture) }}"
                 alt="photo de profil de {{ucfirst($announcement->title)}}"/>
        @else
            <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
        @endif
        <h3 aria-level="3">
            <span class="hidden">Annonce séléctionnée</span> {{ucfirst($announcement->title)}}
        </h3>
    </div>
    <p>
        {{ucfirst($announcement->description)}}
    </p>
</div>
<div class="container-perso-infos container-six-category-home" itemscope
     itemtype="https://schema.org/Person">
    <div>
        <img src="{{asset('svg/envelope.svg')}}" alt="icone de mail">
        <a itemprop="email"
           href="mailto:{{$announcement->user->email}}">{{$announcement->user->email}}</a>
    </div>
    @foreach($announcement->user->phones as $up)
        @if($up->number != null)
            <div>
                <img src="{{asset('svg/phone.svg')}}" alt="icone de téléphone">
                <a itemprop="telephone" href="tel:{{$up->number}}">{{$up->number}}</a>
            </div>
        @endif
    @endforeach
    <div>
        <img src="{{asset('svg/calendar.svg')}}" alt="icone de calendrier">
        <span>
                            Pour le mois de {{$announcement->startmonth->name}}
                        </span>
    </div>
    <div>
        <img src="{{asset('svg/suitcase.svg')}}" alt="icone de malette">
        <span class="job-cat-ads" itemprop="jobTitle">
                        <span>{{ucfirst($announcement->job)}}</span>
                        @if($announcement->categoryAds->count())
                <span class="categoryJob">
                                (@foreach($announcement->categoryAds as $a){{$a->name}}{{ ($loop->last ? '' : ', ') }}@endforeach)
                            </span>
            @endif
                        </span>
    </div>
    @if(!$announcement->pricemax)
        <div itemscope itemtype="https://schema.org/PriceSpecification">
            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
            <span itemprop="price">Max : non déterminer</span>
        </div>
    @else
        <div itemscope itemtype="https://schema.org/PriceSpecification">
            <img src="{{asset('svg/euro.svg')}}" alt="icone d'euro">
            <span itemprop="price">Max : {{$announcement->pricemax}} €</span>
        </div>
    @endif
    <div itemscope itemtype="https://schema.org/PostalAddress">
        <img src="{{asset('svg/placeholder.svg')}}" alt="icone de position">
        <span>
                            @if($announcement->adress)
                <span itemprop="streetAddress">{{ucfirst($announcement->adress)}}</span>
            @endif
                                <span itemprop="addressRegion">{{ucfirst($announcement->province->name)}}</span>
                        </span>
    </div>
</div>
