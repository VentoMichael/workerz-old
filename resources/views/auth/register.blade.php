@extends('layouts.app')

@section('content')
    @if($request->has('user') || $request->old('type') == 'user' || $request->has('company') || $request->old('type') == 'company')
        @if($request->has('company') || $request->old('type') == 'company')
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
        @if($request->has('user') || $request->old('type') == 'user')
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
            @if($request->has('company') || $request->has('user') || $request->old('type') == 'user' || $request->old('type') == 'company')
                <p>Après cette étape, vous serez immédiatement inscris et pourrez y intégrer des annonces !</p>
            @endif
        </div>
        @if($request->has('company') || $request->has('user') || $request->old('type') == 'user' || $request->old('type') == 'company')
            <a class="link-back" href="{{route('users.type')}}">
                <button class="button-back button-cta">
                    Retour
                </button>
            </a>
        @endif

        @if($request->has('user') || $request->old('type') == 'user')
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
                                   class=" @error('phone') is-invalid @enderror email-label" name="phone" required aria-required="true">
                            @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                            @endif
                        </div>
                    </div>
                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="name">Nom<span class="required"> *</span></label>
                            <input type="text" id="name" value="{{old("name")}}" placeholder="Rotis"
                                   class=" @error('name') is-invalid @enderror email-label" name="name" required aria-required="true">
                        </div>
                        <div class="container-form-email">
                            <label for="surname">Prénom<span class="required"> *</span></label>
                            <input type="text" id="surname" placeholder="Daniel" value="{{old("surname")}}"
                                   class=" @error('surname') is-invalid @enderror email-label" name="surname" required aria-required="true">
                        </div>

                    </div>
                    <input id="role_id" name="role_id" type="hidden" value="3">
                    <input id="plan_user_id" name="plan_user_id" type="hidden" value="{{$plan}}">
                    <input id="plan" name="plan" type="hidden" value="{{$plan}}">

                    @include('partials.register')
                </form>
            </div>
        @endif
        @if($request->has('company') || $request->old('type') == 'company')
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
                            @error('picture')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="container-form-email">
                            <label for="catchPhrase">Phrase d'accroche</label>
                            <input type="text" id="catchPhrase" value="{{old("catchPhrase")}}"
                                   class="email-label" name="catchPhrase"
                                   placeholder="Une entreprise qui vous satisfera">
                            <p class="help">
                                Attirer la clientèle à votre façon (optionnel)
                            </p>
                        </div>
                        <div class="container-form-email">
                            <label for="name">Nom du commerce <span class="required">*</span></label>
                            <input type="text" id="name" value="{{old("name")}}" placeholder="Rotis"
                                   class=" @error('name') is-invalid @enderror email-label inputPhone" name="name" required aria-required="true">
                            @error('name')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="adress">Adresse postale</label>
                            <input type="text" id="adress" value="{{old("adress")}}"
                                   class=" @error('adress') is-invalid @enderror email-label" name="adress"
                                   placeholder="Rue des cocotier, 21">
                            @error('adress')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="container-form-email">
                            <label for="phone">Numéro de téléphone <span class="required">*</span></label>
                            <input placeholder="0494827263" minlength="6" maxlength="15" type="tel"
                                   pattern="^[0-9-+\s()]*$" id="phone" value="{{old("phone")}}"
                                   class=" @error('phone') is-invalid @enderror email-label inputPhone" name="phone" required aria-required="true">
                            @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                            @endif
                            @error('phone')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="website">Site internet</label>
                            <input placeholder="https://workerz.be" type="text" id="website" value="{{old("website")}}"
                                   class=" @error('website') is-invalid @enderror email-label" name="website">
                            @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                            @endif
                            @error('website')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="container-form-email selectdiv">
                            <label for="disponibilities">Disponibilités</label>
                            <select class="select-register" multiple name="disponibilities[]" id="disponibilities">
                                @foreach($disponibilities as $d)
                                    <option @if($d->pre_selected == true) selected
                                            @endif value="{{$d->id}}">{{$d->name}}</option>
                                @endforeach
                                @error('disponibilities')
                                <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                                </div>
                                @enderror
                                    <p class="help">Veuillez séléctionner vos jours d'ouvertures</p>
                            </select>
                        </div>
                    </div>

                    <div class="container-register-form">
                        <div class="container-form-email selectdiv">
                            <label for="location">Région <span class="required">*</span></label>
                            <select
                                    @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                    class="email-label"
                                    data-maxoption="1"
                                    @endif
                                    @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2) class="select-register"
                                    multiple data-maxoption="2"
                                    @endif
                                    @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3) class="select-register"
                                    multiple data-maxoption="3"
                                    @endif
                                    name="location"
                                    id="location">
                                @foreach($regions as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                @endforeach
                            </select>

                            @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 2</p>
                            @endif
                            @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 3</p>
                            @endif

                            @error('location')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="container-form-email">
                            <label for="job">Metier <span class="required">*</span></label>
                            <input type="text" id="job" value="{{old("job")}}"
                                   class=" @error('job') is-invalid @enderror email-label" name="job"
                                   placeholder="Menuisier"
                                   required aria-required="true">
                            @error('job')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="container-register-form">
                        <div class="container-form-email selectdiv">
                            <label for="category_job">Catégorie de métier <span class="required">*</span></label>
                            <select
                                    @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                    class="email-label inputPhone"
                                    data-maxoption="1"
                                    @endif
                                    @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2) class="select-register inputPhone"
                                    multiple data-maxoption="2"
                                    @endif
                                    @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3) class="select-register inputPhone"
                                    multiple data-maxoption="3"
                                    @endif name="category_job[]" id="category_job">
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                            @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 1</p>
                            @endif
                            @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 2</p>
                            @endif
                            @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3)
                                <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 3</p>
                            @endif
                            <p class="help proposed-job">Je ne trouve pas mon métier, <a
                                    href="{{route('contact'). '#form'}} ">je le propose</a></p>
                            @error('category_job')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="container-form-email">
                            <label for="pricemax">Votre prix horaire</label>
                            <input max="999999" type="text" id="pricemax" pattern="^[0-9-+\s()]*$" name="pricemax"
                                   value="{{old("pricemax")}}"
                                   class=" @error('pricemax') is-invalid @enderror email-label" placeholder="55"><span
                                class="horary-cost">€/h</span>
                            <p class="help">Ce prix donne un aperçu au client</p>
                            @error('pricemax')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="container-register-form">
                        <div class="container-form-email">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea id="description" name="description" required
                                      class=" @error('description') is-invalid @enderror email-label"
                                      placeholder="Description détailée de votre profil..."
                                      rows="5" cols="33">{{old("description")}}</textarea>
                            @error('description')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <input id="role_id" name="role_id" type="hidden" value="2">
                    <input id="plan_user_id{{$plan}}" name="plan_user_id" type="hidden" value="{{$plan}}">
                    <input id="plan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">
                    <input id="type" name="type" type="hidden" value="company">

                    @include('partials.register')
                </form>
            </div>
        @endif
    </section>
@endsection
@if($request->has('company') || $request->has('user') || $request->old('type') == 'user' || $request->old('type') == 'company')
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
    <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
@endsection
@endif
