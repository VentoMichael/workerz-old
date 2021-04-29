@extends('layouts.app')

@section('content')
    @if(isset($_GET["company"]) || isset($_GET["user"]))
        @if(isset($_GET["company"]))
            <div class="container-home">
                <section class="container-home_image">
                    <div class="container-connexion">

                        <h2 aria-level="2">On vous attend</h2>
                        <p>Vous recherchez du travail ? Engagez-vous !</p>
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
                             alt="Main cliquant sur un écran mobile">
                    </div>
                </section>
            </div>
        @endif
        @if(isset($_GET["user"]))
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
    @else
        <div class="container-home">
            <section class="container-home_image">
                <div class="container-connexion">

                    <h2 aria-level="2">L'inscription à bout de main !</h2>
                    <p>Êtes vous un utilisateur ou un indépendant ?</p>
                    <div>
                        <a href="{{ route('login') }}">
                            <button role="button" class="button-cta" type="submit">
                                J'ai déjà un compte
                            </button>
                        </a>
                    </div>
                </div>
                <div class="container-svg">
                    <img class="svg-icon" src="{{asset('svg/Information_carousel_Isometric.svg')}}"
                         alt="Main cliquant sur un écran mobile">
                </div>
            </section>
        </div>
    @endif
    <section class="container-form-register container-home">
        <div class="title-first-step-register">
            <h2 aria-level="2">Formulaire d'inscription</h2>
            @if(isset($_GET["company"]) || isset($_GET["user"]))
                <p>Après cette étape, vous serez immédiatement inscris et pourrez y intégrer des annonces !</p>
            @else
                <p>Vous êtes à la première étape du formulaire d'inscription</p>
            @endif
        </div>
        @if(isset($_GET["company"]) || isset($_GET["user"]))
            <a class="link-back" href="{{route('register')}}">
                <button class="button-back button-cta">
                    Retour
                </button>
            </a>
        @else
            <form class="form-choice" method="GET"
                  action="{{ route('register') }}">
                <section class="container-role">
                    <div class="container-img-register">
                        <img src="{{asset('svg/user.svg')}}" alt="Photo de profil par défaut d'un utilisateur"></div>
                    <h3 aria-level="3">
                        Je cherche un professionnel
                    </h3>
                    <section class="container-advantages">
                        <h4 aria-level="4">
                                Les avantages
                        </h4>
                        <ul class="list-advantages">
                            <li><span>&bull;</span> Accès à un tableau de bord personnel</li>
                            <li><span>&bull;</span> Intègration d'une annonce</li>
                            <li><span>&bull;</span> Choix parmi une multitude d'entreprises</li>
                            <li><span>&bull;</span> Pleins d'autres avantages</li>
                        </ul>
                    </section>
                    <div class="container-button-register">
                        <button class="button-cta" name="user">
                            Je fais ce choix
                        </button>
                    </div>
                </section>
                <section class="container-role">
                    <div class="container-img-register">
                        <img src="{{asset('svg/suitcase.svg')}}" alt="Photo de profil par défaut d'un professionnel">
                    </div>
                    <h3 aria-level="3">
                        Je suis un professionnel
                    </h3>
                    <section class="container-advantages">
                        <h4 aria-level="4">
                            Les avantages
                        </h4>
                        <ul class="list-advantages">
                            <li><span>&bull;</span> Accès à un tableau de bord personnel</li>
                            <li><span>&bull;</span> Intègration d'une annonce & de votre entreprise</li>
                            <li><span>&bull;</span> Des centaines de clients potentiels</li>
                            <li><span>&bull;</span> Pleins d'autres avantages</li>
                        </ul>
                    </section>
                    <div class="container-button-register">
                        <button class="button-cta" name="company">
                            Je fais ce choix
                        </button>
                    </div>
                </section>
            </form>
        @endif
        @if(isset($_GET["company"]))
            <div>
                <form class="form-login form-register" enctype="multipart/form-data"
                      aria-label="Enregistrement d'un compte" role="form" method="POST"
                      action="{{ route('register') }}">
                    @csrf
                    <div class="container-register-form">
                        <div class="container-form-email">
                            <div class="avatar-container">
                                <label for="picture">Photo du commerce</label>
                                <img id="output" class="preview-picture" alt="Photo du commerce"/>
                            </div>
                            <input type="file"
                                   id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                                   name="picture"
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
                            <label for="pricemax">Votre prix horaire</label>
                            <input type="text" id="pricemax" name="pricemax" value="{{old("pricemax")}}"
                                   class=" @error('pricemax') is-invalid @enderror email-label" placeholder="55"><span
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
                    <input id="role_id" name="role_id" type="hidden" value="2">

                    @include('partials.register')

                </form>
            </div>
        @endif
        @if(isset($_GET["user"]))
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

                    @include('partials.register')
                </form>
            </div>
        @endif
    </section>
@endsection
@if(isset($_GET["company"]) || isset($_GET["user"]))
@section('scripts')
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script>let a=document.getElementById("picture"),t=document.getElementById("output");a.addEventListener("change",e=>{t.style.display="block",t.src=URL.createObjectURL(e.target.files[0]),t.onload=function(){URL.revokeObjectURL(t.src)}});</script>
@endsection
@endif
