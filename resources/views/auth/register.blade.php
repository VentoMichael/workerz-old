@extends('layouts.app')
@section('content')
    @if($type == 'user' || $request->type == 'user' || $request->type == 'company' || $type == 'company')
        @if($type == 'company' || $request->type == 'company')
            <div class="container-home">
                <section class="container-home_image">
                    <div class="container-connexion">
                        <h2 aria-level="2">On vous attend</h2>
                        <p>Vous recherchez du travail&nbsp;? Engagez-vous&nbsp;!</p>
                        @guest
                            <div>
                                <a class="button-cta" href="{{ route('login') }}">
                                        J'ai déjà un compte
                                </a>
                            </div>
                        @endguest
                    </div>
                    <div class="container-svg">
                        <img width="300" height="300" class="svg-icon" src="{{asset('svg/Waiting_Monochromatic.svg')}}"
                             alt="Main cliquant sur un écran mobile">
                    </div>
                </section>
            </div>
        @endif
        @if($type == 'user' || $request->type == 'user')
            <div class="container-home">
                <section class="container-home_image">
                    <div class="container-connexion">

                        <h2 aria-level="2">On vous attend</h2>
                        <p>Vous ne trouvez pas le bon travailleur&nbsp;? Inscrivez-vous et postez une annonce&nbsp;!</p>
                        <div>
                            <a href="{{ route('login') }}">
                                <button role="button" class="button-cta" type="submit">
                                    J'ai déjà un compte
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="container-svg">
                        <img width="300" height="300" class="svg-icon" src="{{asset('svg/Waiting_Monochromatic.svg')}}"
                             alt="Femme attendant sur un sablier">
                    </div>
                </section>
            </div>
        @endif
    @endif
    <section class="container-form-register container-home">
        <div class="title-first-step-register">
            <h2 aria-level="2">Formulaire d'inscription</h2>
            @if($type == 'company' || $type == 'user' || $request->type == 'user' || $request->type == 'company')
                <p>Après cette étape, vous serez immédiatement inscris et pourrez insérer des annonces&nbsp;!</p>
            @endif
        </div>
        @if($type == 'company' || $type == 'user' || $request->type == 'user' || $request->type == 'company')
            <a class="link-back button-back button-cta" href="{{route('users.type')}}">
                    Retour
            </a>
        @endif

        @if($type == 'user' || $request->type == 'user')
            @include('layouts.formUser')
        @endif
        @if($type == 'company' || $request->type == 'company')
            @include('layouts.formCompany')
        @endif
    </section>
@endsection
@if($type == 'company' || $type == 'user' || $request->type == 'user' || $request->type == 'company')
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
    @if($plan == 1 || $request->plan == 1)
        <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
    @endif
    @if($plan == 2 || $request->plan == 2)
        <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
    @endif
    @if($plan == 3 || $request->plan == 3)
        <script src="{{asset('js/checkDataMaxOptions3.js')}}"></script>
    @endif
@endsection
@endif
