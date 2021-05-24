@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                @if(auth()->user()->announcements()->NotDraft()->count() > 1)
                    Annonces
                @else
                    Annonce
                @endif
                mise en ligne
            </h2>
            <div class="container-form-ads">
                <livewire:ads-dashboard>
                </livewire:ads-dashboard>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-buttons-delete-back">
                        <a class="link-back" href="{{route('dashboard.ads')}}">
                            <button class="button-back button-cta button-draft">
                                Retour
                            </button>
                        </a>
                        <form action="/dashboard/ads/delete/{{$announcement->slug}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteButton" class="button-cta button-delete" name="delete">
                                Je supprime {{$announcement->title}}
                            </button>
                        </form>
                    </div>
                    <div class="container-picture-title-dashboard-ads">
                        @if($announcement->catchPhrase)
                            <p class="container-ads-catch_phrase-dashboard">
                                {{$announcement->catchPhrase}}
                            </p>
                        @endif
                        <div class="container-picture-dashboard">
                            @if($announcement->picture)
                                <img itemprop="image" src="{{ asset($announcement->picture) }}"
                                     alt="photo de profil de {{ucfirst($announcement->title)}}"/>
                            @else
                                <img itemprop="image" src="{{asset('svg/ad.svg')}}" alt="icone d'annonces">
                            @endif
                            <h4 aria-level="4">
                                {{$announcement->title}}
                            </h4>
                        </div>
                        <p>
                            {{$announcement->description}}
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
                            À partir de {{$announcement->startmonth->name}}
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
                                    <span itemprop="streetAddress">{{$announcement->adress}}</span>
                                @endif
                                <span itemprop="addressRegion">{{ucfirst($announcement->province->name)}}</span>
                        </span>
                        </div>
                    </div>
                    <a href="{{route('update.ads.dashboard',$announcement->slug)}}" class="button-cta">
                        J'édite {{$announcement->title}}
                    </a>
                </section>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/confirmDelete.js')}}"></script>
    @livewireScripts
@endsection
