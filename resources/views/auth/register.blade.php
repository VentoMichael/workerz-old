@extends('layouts.app')

@section('content')
    <div class="container md:mx-auto md:w-9/12 md:max-w-3xl"">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body flex">
                    <form aria-label="Enregistrement d'un compte" role="form" method="POST" class="w-full m-3" action="{{ route('register') }}">
                        @csrf
                        <div class="sm:flex sm:justify-between">
                            <div class="form-group row sm:w-5/12 mb-6">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="text-lg form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row sm:w-5/12 mb-6">
                                <label for="surname"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>
                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                           class="text-lg form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('surname') is-invalid @enderror"
                                           name="surname"
                                           value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="sm:flex sm:justify-between">
                            <div class="form-group row sm:w-5/12 mb-6">
                                <label for="email"
                                       class="text-lg col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row sm:w-5/12 mb-6">
                                <label for="password"
                                       class="text-lg col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('password') is-invalid @enderror"
                                           name="password"
                                           required autocomplete="new-password">
                                    <ul role="list" class="mt-2">
                                        <li role="listitem" class="text-xs">
                                            Minimum 8 caractères
                                        </li>
                                        <li role="listitem" class="text-xs">
                                            Minimum 1 minuscule
                                        </li>
                                        <li role="listitem" class="text-xs">
                                            Minimum 1 majuscule
                                        </li>
                                        <li role="listitem" class="text-xs">
                                            Minimum 1 chiffre
                                        </li>
                                    </ul>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <button role="button" type="submit">
                                    {{ __('S\'enregistrer') }}
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            @if (Route::has('login'))
                                <a class="btn btn-link underline mt-6" href="{{ route('login') }}">
                                    J'ai déjà un compte
                                </a>
                            @endif
                            @if (Route::has('password.request'))
                                <a class="btn btn-link underline mt-6" href="{{ route('password.request') }}">
                                    J'ai oublié mon mot de passe
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
