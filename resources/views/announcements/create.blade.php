@extends('layouts.app')
@section('content')
    @if(isset($_GET['plan1']) || isset($_GET['plan2']) || isset($_GET['plan3']))
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
                            <label for="title">Titre <span class="required">*</span></label>
                            <input type="text" id="title" value="{{old("title")}}"
                                   class=" @error('email') is-invalid @enderror email-label" name="title"
                                   required placeholder="Menuisier dans liège">
                        </div>
                        <div class="container-form-email">
                            <label for="job">Metier <span class="required">*</span></label>
                            <input placeholder="Menuisier" type="text"
                                   id="job" value="{{old("phone")}}"
                                   class=" @error('job') is-invalid @enderror email-label" name="job" required>
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
                            <label for="disponibility">Disponible à partir du mois de <span
                                    class="required">*</span></label>
                            <select required class="select-register" name="disponibility" id="disponibility">
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
                            <label for="allPhoneNumbers">Afficher tous mes numéros de télèphone ?</label>
                            <div class="container-positive-response">
                                <input type="radio" id="yes" name="allPhoneNumbers">
                                <label for="yes">Oui</label>
                            </div>
                            <div>
                                <input type="radio" id="no" name="allPhoneNumbers" checked>
                                <label for="no">Non</label>
                            </div>
                        </div>
                        <div class="container-form-email">
                            <label for="price-max">Combien voulez vous dépensez au maximum ?</label>
                            <input type="number" pattern="^[0-9-+\s()]*$" id="price-max" name="price-max"
                                   value="{{old("price-max")}}"
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
                        Créer l'annonce
                    </button>
                </form>
            </div>
        </section>
    @else
        <section class="container-home margin">
            <div class="container-home_image container-home-create container-home-page">
                <div>
                    <div class="container-home-text">
                        <h2 aria-level="2">
                            Des clients vous attendent
                        </h2>
                        <p>
                            Après cette étape, votre annonce sera visible parmis beaucoup de potentiels clients !
                        </p>
                    </div>
                </div>
                <div class="container-svg">
                    <img src="{{asset('svg/Success _Monochromatic.svg')}}"
                         alt="Personne choissisant la catégorie de métier">
                </div>
            </div>
        </section>
        <section class="container-home container-announcements container-create-ads">
            <div class="title-first-step-register">
                <h2 aria-level="2">Plan pour votre annonce</h2>
            </div>
            <div class="container-all-announcement show-content container-create-ads-infos container-plans">
                @for($i=1;$i<= 3;$i++)
                    <section class="container-plan">
                        <div class="container-plan-price">
                            <h3>
                                Free
                            </h3>
                            <span class="planPrice">
                                0€
                            </span>
                            <p class="reductionPrice">
                                10€
                            </p>
                        </div>
                        <ul>
                            <li>
                                <img src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée : X jours
                            </li>
                            <li>
                                <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">Support prioritaire
                            </li>
                            <li class="hepling">
                                <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">
                                    Directement visible
                                <span>Visible après approbation de l'administrateur</span>
                            </li>
                            <li>
                                <img src="{{asset('svg/cross.svg')}}" alt="Icone négative">Grande visibilité
                            </li>
                        </ul>
                        <form action="#" method="get">
                            <button name="plan{{$i}}">
                                Je séléctionne TITRE
                            </button>
                        </form>
                    </section>
                @endfor
            </div>
        </section>

    @endif
@endsection
