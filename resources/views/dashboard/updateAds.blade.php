@extends('layouts.appDashboard')
@section('content')
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-ads">
            <h2 aria-level="2">
                Édition de l'annonce {{$announcement->title}}
            </h2>
            <div class="container-form-ads">
                <livewire:ads-dashboard>
                </livewire:ads-dashboard>

                <section class="container-home container-edit-ads container-create-ads">
                    <a class="link-back" href="{{route('announcements.plans')}}">
                        <button class="button-back button-cta button-draft">
                            Retour
                        </button>
                    </a>
                    <div class="title-first-step-register">
                        <h3 aria-level="3">Édition de {{$announcement->title}}</h3>
                    </div>
                    <div class="container-all-announcement show-content container-create-ads-infos">
                        <form class="form-login form-register" enctype="multipart/form-data"
                              aria-label="Enregistrement d'un compte" role="form" method="POST"
                              action="{{ route('announcements.store') }}">
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
                                        <label for="picture">Photo de profil</label>
                                        <img id="output" class="preview-picture" alt="photo du commerce"/>
                                    </div>
                                    <input type="file"
                                           id="picture"
                                           class="input-field @error('picture') is-invalid @enderror email-label"
                                           name="picture"
                                           accept="image/png, image/jpeg">
                                    @error('picture')
                                    <p class="danger help">
                                        {{$errors->first('picture')}}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="container-register-form container-register">
                                <div class="container-form-email category-input">
                                    <label for="title">Titre <span class="required">*</span></label>
                                    <input type="text" id="title" value="{{old("title")}}"
                                           class=" @error('title') is-invalid @enderror email-label" name="title"
                                           required aria-required="true" placeholder="Menuisier dans liège">
                                    @error('title')
                                    <p class="danger help">
                                        {{$errors->first('title')}}
                                    </p>
                                    @enderror
                                </div>
                                <div class="container-form-email container-email-form category-input">
                                    <label for="location">Région <span class="required">*</span></label>
                                    <select required aria-required="true" class="select-register select-regions"
                                            data-maxoption="1" name="location" id="location">
                                        <option value="0" disabled selected>-- Votre région --</option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <p class="danger help">
                                        {{$errors->first('location')}}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="container-register-form container-announcement-create container-register">
                                <div class="container-form-email">
                                    <label for="job">Metier <span class="required">*</span></label>
                                    <input placeholder="Menuisier" type="text"
                                           id="job" value="{{old("job")}}"
                                           class=" @error('job') is-invalid @enderror email-label" name="job" required
                                           aria-required="true">
                                    @error('job')
                                    <p class="danger help">
                                        {{$errors->first('job')}}
                                    </p>
                                    @enderror
                                </div>
                                <div class="container-form-email category-input">

                                    <label for="categoryAds">Catégorie de métier <span class="required">*</span></label>
                                    <div class="container-filter-categories container-category">
                                        <ul class="list-categories">
                                            @foreach($categories as $c)
                                                <li>
                                                    <input role="checkbox"
                                                           aria-checked="false" class="checkCat hiddenCheckbox inp-cbx"
                                                           name="categoryAds[]" id="categoryAds{{$c->id}}"
                                                           type="checkbox" value="{{$c->id}}"/>
                                                    <label class="cbx" for="categoryAds{{$c->id}}">
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
                                    @error('categoryAds')
                                    <p class="danger dangerCategory help">
                                        {{$errors->first('categoryAds')}}
                                    </p>
                                    @enderror
                                    @if($plan == 1)
                                        <p class="help"><a href="{{route('announcements.plans')}}#plans">Augmenter votre
                                                plan</a> et
                                            vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                                    @endif
                                    @if($plan == 2)
                                        <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 2</p>
                                    @endif
                                    @if($plan == 3)
                                        <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 3</p>
                                    @endif


                                </div>
                            </div>

                            <div class="container-register-form container-register">
                                <div class="container-form-email">
                                    <label for="price_max">Combien voulez vous dépensez au maximum ?</label>
                                    <input type="text" pattern="^[0-9-+\s()]*$" id="price_max" name="price_max"
                                           value="{{old("price-max")}}"
                                           class="email-label" maxlength="999999" placeholder="500"><span
                                        class="horary-cost">€</span>
                                    <p class="help hepl-price">
                                        Cela donne une idée à l'indépendant (optionnel)
                                    </p>
                                </div>
                                <div class="container-form-email selectdiv">
                                    <label for="startmonth">Disponible à partir du mois de <span
                                            class="required">*</span></label>
                                    <div class="container-filter-categories container-category">

                                        <ul class="list-categories">
                                            @foreach($disponibilities as $disponibility)
                                                <li id="checkDispo">
                                                    <input role="checkbox"
                                                           aria-checked="false"
                                                           class="checkDispo hiddenCheckbox inp-cbx"
                                                           name="startmonth" id="startmonth{{$disponibility->id}}"
                                                           type="checkbox" value="{{$disponibility->id}}"/>
                                                    <label class="cbx" for="startmonth{{$disponibility->id}}">
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
                                    </div>
                                    @error('startmonth')
                                    <p class="danger dangerCategory help">
                                        {{$errors->first('startmonth')}}
                                    </p>
                                    @enderror
                                    <p class="help">Vous avez la possibilité d'en ajouter qu'un seul</p>

                                </div>

                            </div>

                            <div>
                                <div class="container-form-email">
                                    <div class="container-maxCharacters">
                                        <label for="description">Description <span class="required">*</span></label>
                                        <span class="maxCharacters">256 caractères max</span>
                                    </div>
                                    <textarea id="description" name="description" required
                                              class=" @error('description') is-invalid @enderror email-label"
                                              placeholder="Description de votre annonce..."
                                              rows="5" cols="33">{{old("description")}}</textarea>
                                    @error('description')
                                    <p class="danger help">
                                        {{$errors->first('description')}}
                                    </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="container-buttons-ads">
                                <div class="link-back">
                                    <button class="button-back button-cta button-draft" name="is_draft">
                                        Je la met en brouillon
                                    </button>
                                </div>
                                <button role="button" class="button-cta" type="submit">
                                    Créer l'annonce
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
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
