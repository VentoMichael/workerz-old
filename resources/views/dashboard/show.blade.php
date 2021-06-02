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
                                Je supprime <i>{{ucfirst($announcement->title)}}</i>
                            </button>
                        </form>
                    </div>
                    @include('partials.profil-ads')
                    <a href="{{route('update.ads.dashboard',$announcement->slug)}}" class="button-cta">
                        J'édite <i>{{ucfirst($announcement->title)}}</i>
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
