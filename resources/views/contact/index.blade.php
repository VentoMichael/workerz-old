@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
            <div class="container-about-text">
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Une demande ?
                    </h2>
                    <p>
                        Pour la moindre question ou une simple demande, n'hésitez pas à nous contacter
                    </p>
                </div>
                <div>
                    <a href="{{ route('users.plans') }}">
                        <button role="button" class="button-cta" type="submit">
                            Je m'inscris
                        </button>
                    </a>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/us.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <livewire:message>
    </livewire:message>
@endsection
@section('scripts')
    @livewireScripts
@endsection
