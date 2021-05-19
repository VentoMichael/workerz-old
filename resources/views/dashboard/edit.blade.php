@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-profil">
            <h2 aria-level="2">
                Profil
            </h2>
            <div class="container-profil-dashboard">
                <div class="container-link-to-back">
                <a class="link-back" href="{{route('dashboard.profil')}}">
                    <button class="button-back button-cta button-draft">
                        Retour
                    </button>
                </a>
                </div>
                @if(auth()->user()->role_id == 2)
                    @include('layouts.formCompany')
                @else
                    @include('layouts.formUser')
                @endif
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
    <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
@endsection
