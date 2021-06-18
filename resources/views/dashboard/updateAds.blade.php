@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                Édition de l'annonce {{ucfirst($announcement->title)}}
            </h2>
            <div class="container-form-ads">
                <livewire:ads-dashboard>
                </livewire:ads-dashboard>

                <section class="container-edit-ads container-create-ads">
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
                    <div class="title-first-step-register">
                        <h3 aria-level="3">Édition de {{ucfirst($announcement->title)}}</h3>
                    </div>
                    <div class="container-all-announcement show-content container-create-ads-infos">
                        <form class="form-login form-register form-edit" enctype="multipart/form-data"
                              aria-label="Modification de {{$announcement->title}}" role="form" method="POST"
                              action="/dashboard/ads/{{$announcement->slug}}">
                            @csrf

                            @method("PUT")
                            @include('partials.update-ads')

                        </form>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/confirmDelete.js')}}"></script>

    <script src="{{asset('js/previewPicture.js')}}"></script>
    @if($plan == 1)
        <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
    @endif
    @if($plan == 2)
        <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
    @endif
    @if($plan == 3)
        <script src="{{asset('js/checkDataMaxOptions3.js')}}"></script>
    @endif
@endsection
