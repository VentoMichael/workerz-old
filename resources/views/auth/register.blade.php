@extends('layouts.app')

@section('content')
    @if($request->has('user') || $request->has('company'))
        @if($request->has('company'))
            <div class="container-home">
                <section class="container-home_image">
                    <div class="container-connexion">

                        <h2 aria-level="2">On vous attend</h2>
                        <p>Vous recherchez du travail ? Engagez-vous !</p>
                        @guest
                            <div>
                                <a href="{{ route('login') }}">
                                    <button role="button" class="button-cta" type="submit">
                                        J'ai déjà un compte
                                    </button>
                                </a>
                            </div>
                        @endguest
                    </div>
                    <div class="container-svg">
                        <img class="svg-icon" src="{{asset('svg/Waiting_Monochromatic.svg')}}"
                             alt="Main cliquant sur un écran mobile">
                    </div>
                </section>
            </div>
        @endif
        @if($request->has('user'))
            <div class="container-home">
                <section class="container-home_image">
                    <div class="container-connexion">

                        <h2 aria-level="2">On vous attend</h2>
                        <p>Vous ne trouvez pas le bon travailleur ? Inscrivez-vous et poster une annonce !</p>
                        <div>
                            <a href="{{ route('login') }}">
                                <button role="button" class="button-cta" type="submit">
                                    J'ai déjà un compte
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="container-svg">
                        <img class="svg-icon" src="{{asset('svg/Waiting_Monochromatic.svg')}}"
                             alt="Femme attendant sur un sablier">
                    </div>
                </section>
            </div>
        @endif
    @endif
    <section class="container-form-register container-home">
        <div class="title-first-step-register">
            <h2 aria-level="2">Formulaire d'inscription</h2>
            @if($request->has('company') || $request->has('user'))
                <p>Après cette étape, vous serez immédiatement inscris et pourrez y intégrer des annonces !</p>
            @endif
        </div>
        @if($request->has('company') || $request->has('user'))
            <a class="link-back" href="{{route('users.type')}}">
                <button class="button-back button-cta">
                    Retour
                </button>
            </a>
        @endif

        @if($request->has('user'))
            <div>
                <form class="form-login form-register" enctype="multipart/form-data"
                      aria-label="Enregistrement d'un compte" role="form" method="POST"
                      action="{{ route('register') }}">
                    @csrf
                    <div class="container-register-form">
                        <div class="container-form-email">
                            <div class="avatar-container">
                                <label for="picture">Photo de profil</label>
                                <img id="output" class="preview-picture" alt="photo du commerce"/>
                            </div>
                            <input type="file"
                                   id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                                   name="picture"
                                   accept="image/png, image/jpeg">

                        </div>
                        <div class="container-form-email">
                            <label for="phone">Numéro de téléphone <span class="required">*</span></label>
                            <input minlength="6" maxlength="15" type="tel" id="phone" pattern="^[0-9-+\s()]*$"
                                   value="{{old("phone")}}" placeholder="0494827235"
                                   class=" @error('phone') is-invalid @enderror email-label" name="phone" required>
                            @if($request->plan_user_id == 1)
                                <p class="help">Augmenter votre plan et vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2)
                            <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                                @endif
                            @if($request->plan_user_id == 3)
                            <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                                @endif
                        </div>
                    </div>
                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="name">Nom<span class="required">*</span></label>
                            <input type="text" id="name" value="{{old("name")}}" placeholder="Rotis"
                                   class=" @error('name') is-invalid @enderror email-label" name="name" required>
                        </div>
                        <div class="container-form-email">
                            <label for="surname">Prénom<span class="required">*</span></label>
                            <input type="text" id="surname" placeholder="Daniel" value="{{old("surname")}}"
                                   class=" @error('surname') is-invalid @enderror email-label" name="surname" required>
                        </div>

                    </div>
                    <input id="role_id" name="role_id" type="hidden" value="3">
                    <input id="plan_user_id" name="plan_user_id" type="hidden" value="{{$plan}}">
                    <input id="plan" name="plan" type="hidden" value="{{$plan}}">

                    @include('partials.register')
                </form>
            </div>
        @endif
        @if($request->has('company'))
            <div>
                <form class="form-login form-register" enctype="multipart/form-data"
                      aria-label="Enregistrement d'un compte" role="form" method="POST"
                      action="{{ route('register') }}">
                    @csrf
                    <div class="container-register-form">
                        <div class="container-form-email">
                            <div class="avatar-container">
                                <label for="picture">Photo du commerce</label>
                                <img id="output" class="preview-picture" alt="photo du commerce"/>
                            </div>
                            <input type="file"
                                   id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                                   name="picture"
                                   accept="image/png, image/jpeg">

                        </div>
                        <div class="container-form-email">
                            <label for="name">Nom du commerce <span class="required">*</span></label>
                            <input type="text" id="name" value="{{old("name")}}" placeholder="Rotis"
                                   class=" @error('name') is-invalid @enderror email-label" name="name" required>
                        </div>
                    </div>
                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="adress">Adresse postale</label>
                            <input type="text" id="adress" value="{{old("adress")}}"
                                   class=" @error('adress') is-invalid @enderror email-label" name="adress"
                                   placeholder="Rue des cocotier, 21">
                        </div>
                        <div class="container-form-email">
                            <label for="phone">Numéro de téléphone <span class="required">*</span></label>
                            <input placeholder="0494827263" minlength="6" maxlength="15" type="tel"
                                   pattern="^[0-9-+\s()]*$" id="phone" value="{{old("phone")}}"
                                   class=" @error('phone') is-invalid @enderror email-label" name="phone" required>
                            @if($request->plan_user_id == 1)
                                <p class="help"><a href="{{route('users.plans')}}">Augmenter votre plan</a> et vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($request->plan_user_id == 3)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                            @endif
                        </div>
                    </div>

                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="website">Site internet</label>
                            <input placeholder="www.workerz.be" type="text" id="website" value="{{old("website")}}"
                                   class=" @error('website') is-invalid @enderror email-label" name="website">
                            @if($request->plan_user_id == 1)
                                <p class="help"><a href="{{route('users.plans')}}">Augmenter votre plan</a> et vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($request->plan_user_id == 3)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                            @endif
                        </div>
                        <div class="container-form-email selectdiv">
                            <label for="disponibilities">Disponibilités</label>
                            <select class="select-register" multiple name="disponibilities[]" id="disponibilities">
                                @foreach($disponibilities as $d)
                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                @endforeach
                            </select>
                            @if($request->plan_user_id == 1)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 2</p>
                            @endif
                            @if($request->plan_user_id == 2)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 3)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 5</p>
                            @endif
                        </div>
                    </div>

                    <div class="container-register-form">
                        <div class="container-form-email selectdiv">
                            <label for="location">Région <span class="required">*</span></label>
                            <select class="select-register select-region" name="location" id="location">
                                @foreach($regions as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container-form-email">
                            <label for="job">Metier <span class="required">*</span></label>
                            <input type="text" id="job" value="{{old("job")}}"
                                   class=" @error('job') is-invalid @enderror email-label" name="job"
                                   placeholder="Menuisier"
                                   required>
                        </div>
                    </div>

                    <div class="container-register-form">
                        <div class="container-form-email selectdiv">
                            <label for="category-job">Catégorie de métier <span class="required">*</span></label>
                            <select class="select-register" multiple name="category-job[]" id="category-job">
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                            @if($request->plan_user_id == 1)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 2</p>
                            @endif
                            @if($request->plan_user_id == 2)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 3)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 5</p>
                            @endif
                        </div>
                        <div class="container-form-email">
                            <label for="pricemax">Votre prix horaire</label>
                            <input type="text" id="pricemax" pattern="^[0-9-+\s()]*$" name="pricemax"
                                   value="{{old("pricemax")}}"
                                   class=" @error('pricemax') is-invalid @enderror email-label" placeholder="55"><span
                                class="horary-cost">€/h</span>
                            <p class="help">Ce prix donne un aperçu au client</p>
                        </div>
                    </div>

                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea id="description" name="description" required
                                      class=" @error('description') is-invalid @enderror email-label"
                                      placeholder="Description détailée de votre profil..."
                                      rows="5" cols="33">{{old("description")}}</textarea>
                        </div>
                    </div>
                    <input id="role_id" name="role_id" type="hidden" value="2">
                    <input id="plan_user_id{{$plan}}" name="plan_user_id" type="hidden" value="{{$plan}}">
                    <input id="plan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">

                    @include('partials.register')
                </form>
            </div>
        @endif
    </section>
@endsection
@if($request->has('company') || $request->has('user'))
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script>let a=document.getElementById("picture"),t=document.getElementById("output");a.addEventListener("change",e=>{t.style.display="block",t.src=URL.createObjectURL(e.target.files[0]),t.onload=function(){URL.revokeObjectURL(t.src)}});</script>
@endsection
@endif
