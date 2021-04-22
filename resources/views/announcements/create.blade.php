@extends('layouts.app')
@section('content')
    <section class="container-home margin">
        <div class="container-home_image container-home-page">
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
                <img src="{{asset('svg/Information carousel_Monochromatic.svg')}}"
                     alt="Personne choissisant la catégorie de métier">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements show-content">
        <h2 class="hidden" aria-level="2">
            Développement d'une annonce
        </h2>
        <div>
            <form class="form-login form-register" enctype="multipart/form-data"
                  aria-label="Enregistrement d'un compte" role="form" method="POST"
                  action="{{ route('register') }}">
                @csrf
                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="adress">Titre</label>
                        <input type="text" id="adress" value="{{old("email")}}"
                               class=" @error('email') is-invalid @enderror email-label" name="adress"
                               placeholder="Menuisier dans liège">
                    </div>
                    <div class="container-form-email">
                        <label for="phone">Metier <span class="required">*</span></label>
                        <input placeholder="Menuisier" type="text"
                               id="phone" value="{{old("phone")}}"
                               class=" @error('phone') is-invalid @enderror email-label" name="phone" required>
                    </div>
                </div>

                <div class="container-register-form container-announcement-create">
                    <div class="container-form-email selectdiv">
                        <label for="location">Région <span class="required">*</span></label>
                        <select class="select-register" name="location" id="location">
                            <option value="liege">Liège</option>
                            <option value="tuesday">Mardi</option>
                            <option value="wednesday">Mercredi</option>
                            <option value="thursday">Jeudi</option>
                            <option value="friday">Vendredi</option>
                            <option value="saturday">Samedi</option>
                            <option value="sunday">Dimanche</option>
                        </select>
                        <p class="help">
                            Vous ne trouvez pas votre région ? Choisissez la plus proche de la vôtre
                        </p>
                    </div>
                    <div class="container-form-email selectdiv">
                        <label for="location">Disponible à partir du mois de</label>
                        <select class="select-register" name="location" id="location">
                            <option value="liege">Liège</option>
                            <option value="tuesday">Mardi</option>
                            <option value="wednesday">Mercredi</option>
                            <option value="thursday">Jeudi</option>
                            <option value="friday">Vendredi</option>
                            <option value="saturday">Samedi</option>
                            <option value="sunday">Dimanche</option>
                        </select>
                    </div>
                </div>

                <div class="container-register-form">
                    <div class="container-form-email selectdiv">
                        <label for="category-job">Afficher tous mes numéros de télèphone ?</label>
                        <div>
                            <input type="radio" id="yes" name="multipleNumber" value="yes"
                                   checked>
                            <label for="yes">Oui</label>
                        </div>
                        <div>
                            <input type="radio" id="no" name="multipleNumber" value="no">
                            <label for="no">No</label>
                        </div>
                    </div>
                    <div class="container-form-email">
                        <label for="price-max">Combien voulez vous dépenses au maximum ?</label>
                        <input type="text" id="price-max" name="price-max" value="{{old("price-max")}}"
                               class=" @error('price-max') is-invalid @enderror email-label" placeholder="500"><span
                            class="horary-cost">€</span>
                        <p class="help">
                            Cela donne une idée à l'indépendant (optionnel)
                        </p>
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
            </form>
        </div>









        <div>
            <form class="form-login form-register" enctype="multipart/form-data"
                  aria-label="Enregistrement d'un compte" role="form" method="POST"
                  action="{{ route('register') }}">
                @csrf
                <div class="container-register-form">
                    <div class="container-form-email">
                        <div class="avatar-container">
                            <label for="avatar">Photo du commerce</label>
                            <img id="output" class="preview-picture" alt="Photo du commerce"/>
                        </div>
                        <input type="file"
                               id="avatar" class="input-field @error('avatar') is-invalid @enderror email-label"
                               name="avatar"
                               accept="image/png, image/jpeg">
                    </div>
                    <div class="container-form-email">
                        <label for="name">Nom du commerce <span class="required">*</span></label>
                        <input placeholder="Le cocoter SRL" type="text" id="name" value="{{old("name")}}"
                               class=" @error('name') is-invalid @enderror email-label" name="name" required>
                    </div>
                </div>

                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="adress">Adresse postale</label>
                        <input type="text" id="adress" value="{{old("email")}}"
                               class=" @error('email') is-invalid @enderror email-label" name="adress"
                               placeholder="Rue des cocotier, 21">
                    </div>
                    <div class="container-form-email">
                        <label for="phone">Numéro de téléphone <span class="required">*</span></label>
                        <input placeholder="0494827263" minlength="6" maxlength="15" type="tel"
                               pattern="^[0-9-+\s()]*$" id="phone" value="{{old("phone")}}"
                               class=" @error('phone') is-invalid @enderror email-label" name="phone" required>
                    </div>
                </div>

                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="website">Site internet</label>
                        <input placeholder="www.workerz.be" type="text" id="website" value="{{old("website")}}"
                               class=" @error('website') is-invalid @enderror email-label" name="website">
                    </div>
                    <div class="container-form-email selectdiv">
                        <label for="disponibilities">Disponibilités</label>
                        <select class="select-register" multiple name="disponibilities[]" id="disponibilities">
                            <option value="monday">Lundi</option>
                            <option value="tuesday">Mardi</option>
                            <option value="wednesday">Mercredi</option>
                            <option value="thursday">Jeudi</option>
                            <option value="friday">Vendredi</option>
                            <option value="saturday">Samedi</option>
                            <option value="sunday">Dimanche</option>
                        </select>
                    </div>
                </div>

                <div class="container-register-form">
                    <div class="container-form-email selectdiv">
                        <label for="location">Région <span class="required">*</span></label>
                        <select class="select-register" multiple name="location[]" id="location">
                            <option value="liege">Liège</option>
                            <option value="tuesday">Mardi</option>
                            <option value="wednesday">Mercredi</option>
                            <option value="thursday">Jeudi</option>
                            <option value="friday">Vendredi</option>
                            <option value="saturday">Samedi</option>
                            <option value="sunday">Dimanche</option>
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
                            <option value="education">Éducation</option>
                            <option value="tuesday">Mardi</option>
                            <option value="wednesday">Mercredi</option>
                            <option value="thursday">Jeudi</option>
                            <option value="friday">Vendredi</option>
                            <option value="saturday">Samedi</option>
                            <option value="sunday">Dimanche</option>
                        </select>
                    </div>
                    <div class="container-form-email">
                        <label for="price-h">Votre prix horaire</label>
                        <input type="text" id="price-h" name="price-h" value="{{old("price-h")}}"
                               class=" @error('price-h') is-invalid @enderror email-label" placeholder="55"><span
                            class="horary-cost">€/h</span>
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
                @include('partials.register')

            </form>
        </div>
    </section>
@endsection
