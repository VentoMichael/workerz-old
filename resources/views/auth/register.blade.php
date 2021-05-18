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
                    <div class="container-register-form container-register">
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
                                   class=" @error('phone') is-invalid @enderror email-label" name="phone" required
                                   aria-required="true">
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
                    <div class="container-register-form container-register">
                        <div class="container-form-email">
                            <label for="name">Nom<span class="required"> *</span></label>
                            <input type="text" id="name" value="{{old("name")}}" placeholder="Rotis"
                                   class=" @error('name') is-invalid @enderror email-label" name="name" required
                                   aria-required="true">
                            @error('name')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="container-form-email">
                            <label for="surname">Prénom<span class="required"> *</span></label>
                            <input type="text" id="surname" placeholder="Daniel" value="{{old("surname")}}"
                                   class=" @error('surname') is-invalid @enderror email-label" name="surname" required
                                   aria-required="true">
                        </div>

                    </div>
                    @include('partials.register')
                    <div>
                        <input id="role_id" name="role_id" type="hidden" value="3">
                        <input id="plan_user_id" name="plan_user_id" type="hidden" value="{{$plan}}">
                        <input id="plan" name="plan" type="hidden" value="{{$plan}}">
                        <input id="plan" name="type" type="hidden" value="user">
                        <input type="hidden" name="type" value="user">
                        <button role="button" class="button-cta" name="user" type="submit">
                            Finaliser l'inscription
                        </button>
                    </div>
                </form>
            </div>
        @endif
        @if($request->has('company') || $request->old('type') == 'company')
            <div>
                <form class="form-login form-register" enctype="multipart/form-data"
                      aria-label="Enregistrement d'un compte" role="form" method="POST"
                      action="{{ route('register') }}">
                    @csrf
                    <div class="container-register-form container-register">
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
                    </div>
                    <div class="container-register-form container-register">
                        <div class="container-form-email">
                            <label for="name">Nom du commerce <span class="required">*</span></label>
                            <input type="text" id="name" value="{{old("name")}}" placeholder="Rotis"
                                   class=" @error('name') is-invalid @enderror email-label inputPhone" name="name"
                                   required aria-required="true">
                            @error('name')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div class="container-form-email">
                            <span>Possibilités d'emplois dans l'entreprise</span>
                            <ul id="jobOpportunity">
                                <li>
                                    <input role="radio"
                                           aria-checked="false" class="hiddenRadio inp-cbx"
                                           id="jobOpportunityYes"
                                           name="jobOpportunity"
                                           type="radio" value="yes"/>
                                    <label class="cbx" for="jobOpportunityYes">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                        <span>Oui</span>
                                    </label>
                                </li>
                                <li>
                                    <input role="radio"
                                           aria-checked="false" class="hiddenRadio inp-cbx"
                                           id="jobOpportunityNo"
                                           name="jobOpportunity"
                                           type="radio" value="non"/>
                                    <label class="cbx" for="jobOpportunityNo">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                        <span>Non</span>
                                    </label>
                                </li>
                                <li>
                                    <input role="radio"
                                           aria-checked="true" checked class="hiddenRadio inp-cbx"
                                           id="jobOpportunityNotDetermine"
                                           name="jobOpportunity"
                                           type="radio" value="notDetermine"/>
                                    <label class="cbx" for="jobOpportunityNotDetermine">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                        <span>Non déterminer</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="container-register-form container-register">
                        <div class="container-form-email">
                            <label for="adress">Adresse du siège social</label>
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
                                   class=" @error('phone') is-invalid @enderror email-label inputPhone" name="phone"
                                   required aria-required="true">
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

                    <div class="container-register-form container-register">
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
                            <div class="container-filter-categories container-category">
                                <ul class="list-categories list-checkboxes-register">
                                    @foreach($disponibilities as $disponibility)
                                        <li>
                                            <input @if($disponibility->pre_selected == true) checked
                                                   @endif role="checkbox"
                                                   aria-checked="false" class=" hiddenCheckbox inp-cbx"
                                                   name="disponibility" id="disponibility{{$disponibility->id}}"
                                                   type="checkbox" value="{{$disponibility->id}}"/>
                                            <label class="cbx" for="disponibility{{$disponibility->id}}">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span>
                                                    {{$disponibility->name}}
                                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                                @error('disponibilities')
                                <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                                </div>
                                @enderror
                            </div>
                            <p class="help">Veuillez séléctionner vos jours d'ouvertures</p>
                        </div>
                    </div>

                    <div class="container-register-form container-register">
                        <div class="container-form-email selectdiv">
                            <label for="location">Région <span class="required">*</span></label>
                            <select required aria-required="true" class="select-register select-regions" data-maxoption="1" name="location" id="location">
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                            @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2)
                                <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3)
                                <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
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
                    <div class="container-register-form container-register">
                        <div class="container-form-email selectdiv">
                            <label for="category_job">Catégorie de métier <span class="required">*</span></label>
                            <div class="container-filter-categories container-category">
                                <ul class="list-categories list-checkboxes-register">
                                    @foreach($categories as $c)
                                        <li>
                                            <input role="checkbox"
                                                   aria-checked="false" class="checkCat hiddenCheckbox inp-cbx"
                                                   name="category_job[]" id="category_job{{$c->id}}"
                                                   type="checkbox" value="{{$c->id}}"/>
                                            <label class="cbx" for="category_job{{$c->id}}">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                                                <span>
                                                    {{$c->name}}
                                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                            @if($request->plan_user_id == 1 || $request->old('plan_user_id') == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($request->plan_user_id == 2 || $request->old('plan_user_id') == 2)
                                <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 2</p>
                            @endif
                            @if($request->plan_user_id == 3 || $request->old('plan_user_id') == 3)
                                <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 3</p>
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
                    <div class="container-register-form container-register">
                        <div class="container-form-email">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea id="description" maxlength="256" name="description" required
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

                    @include('partials.register')
                    <div><input id="role_id" name="role_id" type="hidden" value="2">
                        <input id="plan_user_id{{$plan}}" name="plan_user_id" type="hidden" value="{{$plan}}">
                        <input id="plan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">
                        <input id="type" name="type" type="hidden" value="company">
                        <input type="hidden" name="type" value="company">
                        <button role="button" class="button-cta" name="company" type="submit">
                            Finaliser l'inscription
                        </button>
                    </div>
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
    @if($request->plan_user_id == 1)
        <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
    @endif
    @if($request->plan_user_id == 2)
        <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
    @endif
    @if($request->plan_user_id == 3)
        <script src="{{asset('js/checkDataMaxOptions3.js')}}"></script>
    @endif
@endsection
@endif
