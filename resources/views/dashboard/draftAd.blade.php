@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('success-update-not'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="pictogramme d'un v correct">
            <p>{!!session('success-update-not')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('success-update'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="pictogramme d'un v correct">
            <p>{!!session('success-update')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('draft'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="pictogramme d'un v correct">
            <p>{!!session('draft')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                @if(auth()->user()->announcements()->Draft()->count() > 1)
                    Annonces
                @else
                    Annonce
                @endif
                mise en brouillon
            </h2>
            <div class="container-form-ads">
                <livewire:ads-draft-dashboard>
                </livewire:ads-draft-dashboard>
                <section class="container-profil-dashboard container-ads-dashboard">
                    <div class="container-buttons-delete-back container-button-delete-ad">
                        <a class="link-back" href="{{route('dashboard.ads')}}">
                            <button class="button-back button-cta button-draft button-back-ads">
                                Retour
                            </button>
                        </a>
                        <form action="/dashboard/ads/draft/delete/{{$announcement->slug}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteButton" class="button-cta button-delete" name="delete">
                                Je supprime <i>{{ucfirst($announcement->title)}}</i>
                            </button>
                        </form>
                    </div>
                    @include('partials.profil-ads')
                    <div class="container-draft-publish-dashboard container-btn-draft">
                        <form class="form-login form-register" enctype="multipart/form-data"
                              aria-label="Publié mon brouillon" role="form" method="POST"
                              action="/dashboard/ads/draft/{{$announcement->slug}}">
                            @csrf
                            @method("PUT")
                            <div class="link-back">
                                <button class="button-back button-cta button-draft" name="publish">
                                    Je poste <i>{{ucfirst($announcement->title)}}</i>
                                </button>
                            </div>
                        </form>
                        <a href="{{route('dashboard.ads.showDraftEdit',$announcement->slug)}}" class="button-cta">
                            J'édite <i>{{ucfirst($announcement->title)}}</i>
                        </a>
                    </div>

                </section>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/confirmDelete.js')}}"></script>
    @livewireScripts
@endsection
