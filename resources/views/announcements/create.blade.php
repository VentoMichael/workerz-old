@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Développons cette annonce !
                    </h2>
                    <p>
                        Vous souhaitez un indépendant pour réaliser vos demandes, ca se trouve ici
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img src="{{asset('svg/Great idea_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads">
        <a class="link-back" href="{{route('announcements.plans')}}">
            <button class="button-back button-cta">
                Retour
            </button>
        </a>
        <div class="title-first-step-register">
            <h2 aria-level="2">Développement d'une annonce</h2>
        </div>
        <div class="container-all-announcement show-content container-create-ads-infos">
            <form class="form-login form-register" enctype="multipart/form-data"
                  aria-label="Enregistrement d'un compte" role="form" method="POST"
                  action="{{ route('announcements.store') }}">
                @csrf
                <div class="container-register-form">
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
                               id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                               name="picture"
                               accept="image/png, image/jpeg">
                        @error('picture')
                        <p class="danger help">
                            {{$errors->first('picture')}}
                        </p>
                        @enderror
                    </div>
                </div>
                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="title">Titre <span class="required">*</span></label>
                        <input type="text" id="title" value="{{old("title")}}"
                               class=" @error('title') is-invalid @enderror email-label" name="title"
                               required placeholder="Menuisier dans liège">
                        @error('title')
                        <p class="danger help">
                            {{$errors->first('title')}}
                        </p>
                        @enderror
                    </div>
                    <div class="container-form-email">
                        <label for="location">Région <span class="required">*</span></label>
                        <select required class="select-register select-regions" name="location" id="location">
                            @foreach($regions as $region)
                                <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="container-register-form container-announcement-create">
                    <div class="container-form-email">
                        <label for="job">Metier <span class="required">*</span></label>
                        <input placeholder="Menuisier" type="text"
                               id="job" value="{{old("job")}}"
                               class=" @error('job') is-invalid @enderror email-label" name="job" required>
                        @error('job')
                        <p class="danger help">
                            {{$errors->first('job')}}
                        </p>
                        @enderror
                    </div>
                    <div class="container-form-email">

                        <label for="category_job">Catégorie de métier <span class="required">*</span></label>
                        <select required class="select-register select-regions" @if(request('plan') == 1)
                                data-maxoption="1"
                                @endif
                                @if(request('plan') == 2) class="select-register selectdiv" multiple data-maxoption="2"
                                @endif
                                @if(request('plan') == 3) class="select-register selectdiv" multiple data-maxoption="3"
                                @endif name="category_job[]" id="category_job">
                            @foreach($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        @if(request()->plan == 1)
                            <p class="help"><a href="{{route('announcements.plans')}}#plans">Augmenter votre plan</a> et
                                vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                        @endif
                        @if(request()->plan == 2)
                            <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 2</p>
                        @endif
                        @if(request()->plan == 3)
                            <p class="help">Avec la touche ctrl vous en sélectionner jusqu'à 3</p>
                        @endif
                    </div>

                </div>

                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="price_max">Combien voulez vous dépensez au maximum ?</label>
                        <input type="text" pattern="^[0-9-+\s()]*$" id="price_max" name="price_max"
                               value="{{old("price-max")}}"
                               class="email-label" placeholder="500"><span
                            class="horary-cost">€</span>
                        <p class="help">
                            Cela donne une idée à l'indépendant (optionnel)
                        </p>
                    </div>
                    <div class="container-form-email selectdiv">
                        <label for="disponibility">Disponible à partir du mois de <span
                                class="required">*</span></label>
                        <select required class="select-register select-regions" name="disponibility" id="disponibility">
                            @foreach($disponibilities as $disponibility)
                                <option value="{{$disponibility->id}}">{{$disponibility->name}}</option>
                            @endforeach
                        </select>
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
                                  placeholder="Description détailée de votre profil..."
                                  rows="5" cols="33">{{old("description")}}</textarea>
                        @error('description')
                        <p class="danger help">
                            {{$errors->first('description')}}
                        </p>
                        @enderror
                    </div>

                </div>
                <input id="plan" name="plan" type="hidden" value="{{$plan}}">
                <div class="container-buttons-ads">
                    <div class="link-back">
                        <button class="button-back button-cta" name="is_draft">
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
@endsection
@section('scripts')
    <script src="{{asset('js/previewPicture.js')}}"></script>
    <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
@endsection
