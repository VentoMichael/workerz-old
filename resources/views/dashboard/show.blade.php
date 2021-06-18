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
                    <div class="container-buttons-delete-back container-button-delete-ad">
                        <a class="link-back" href="{{route('dashboard.ads')}}">
                            <button class="button-back button-cta button-draft">
                                Retour
                            </button>
                        </a>
                        <form action="/dashboard/ads/delete/{{$announcement->slug}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button id="deleteButton" class="button-cta button-delete" name="delete">
                                Je supprime <i>{{ucfirst($announcement->title)}}</i>
                            </button>
                        </form>
                    </div>
                    @include('partials.profil-ads')
                    <div class="container-buttons-delete-back container-draft-publish-dashboard">
                        <a class="button-back button-cta button-draft button-ad-publish" href="{{route('announcements.show',$announcement->slug)}}">
                                Je vais la voir en ligne
                        </a>
                        <a href="{{route('update.ads.dashboard',$announcement->slug)}}" class="button-cta">
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
