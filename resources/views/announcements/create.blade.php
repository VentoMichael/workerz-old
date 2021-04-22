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
        <div class="title-first-step-register">
            <h2 aria-level="2">Développement d'une annonce</h2>
        </div>
        <div class="container-all-announcement show-content container-create-ads-infos">
            <form class="form-login form-register" enctype="multipart/form-data"
                  aria-label="Enregistrement d'un compte" role="form" method="POST"
                  action="{{ route('register') }}">
                @csrf
                <div class="container-register-form">
                    <div class="container-form-email">
                        <label for="adress">Titre <span class="required">*</span></label>
                        <input type="text" id="adress" value="{{old("email")}}"
                               class=" @error('email') is-invalid @enderror email-label" name="adress"
                               required placeholder="Menuisier dans liège">
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
                        <select required class="select-register" name="location" id="location">
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
                        <label for="location">Disponible à partir du mois de <span class="required">*</span></label>
                        <select required class="select-register" name="location" id="location">
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
                    <div class="container-form-email selectdiv radioButtons">
                        <label for="category-job">Afficher tous mes numéros de télèphone ?</label>
                        <div class="container-positive-response">
                            <input type="radio" id="yes" name="allNumbers">
                            <label for="yes">Oui</label>
                        </div>
                        <div>
                            <input type="radio" id="no" name="allNumbers" checked>
                            <label for="no">Non</label>
                        </div>
                    </div>
                    <div class="container-form-email">
                        <label for="price-max">Combien voulez vous dépensez au maximum ?</label>
                        <input type="text" id="price-max" name="price-max" value="{{old("price-max")}}"
                               class=" @error('price-max') is-invalid @enderror email-label" placeholder="500"><span
                            class="horary-cost">€</span>
                        <p class="help">
                            Cela donne une idée à l'indépendant (optionnel)
                        </p>
                    </div>
                </div>

                <div>
                    <div class="container-form-email">
                        <label for="description">Description <span class="required">*</span></label>
                        <textarea id="description" name="description" required
                                  class=" @error('description') is-invalid @enderror email-label"
                                  placeholder="Description détailée de votre profil..."
                                  rows="5" cols="33">{{old("description")}}</textarea>
                    </div>
                </div>
                <button role="button" class="button-cta" type="submit">
                    Finaliser l'annonce
                </button>
            </form>
        </div>
    </section>
@endsection
