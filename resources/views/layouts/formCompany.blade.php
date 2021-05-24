<div>
    <form class="form-login form-register @if(auth()->user())form-edit @endif" enctype="multipart/form-data"
          aria-label="Enregistrement d'un compte" role="form" method="POST"
          @if(auth()->user()) action="{{ route('dashboard.update') }}"
          @else action="{{ route('register') }}" @endif>
        @csrf
        @if(auth()->user()) @method('PUT') @endif

        <div
            class="container-register-form container-register @if(auth()->user()) container-edition-formulary @endif container-register-user">
            <div class="container-form-email">
                <div class="avatar-container">
                    <label for="picture">Logo</label>
                    <img id="output" class="preview-picture" alt="logo du commerce"/>
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
                <label for="number">Numéro de téléphone <span class="required">*</span></label>
                <input minlength="6" maxlength="15" type="tel" id="phone" pattern="^[0-9-+\s()]*$"
                       @if(auth()->user()) value="{{auth()->user()->phones()->first()->number}}"
                       @else value="{{old('number')}}"                        @endif placeholder="0494827235"
                       class=" @error('number') is-invalid @enderror email-label" name="number" required
                       aria-required="true">
                @error('number')
                <div class="container-error categoerror">
                <span role="alert" class="error">
                    <strong>{{ ucfirst($message) }}</strong>
                </span>
                </div>
                @enderror
                @if(!auth())
                    @if($plan == 1)
                        <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                            vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                    @endif
                    @if($plan == 2)
                        <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                    @endif
                    @if($plan == 3)
                        <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                    @endif
                @endif

            </div>
            @if(auth()->user() && auth()->user()->plan_user_id ==2)

                @if(auth()->user()->phones()->count() > 1)
                    <div class="container-form-email">
                        <label for="phonetwo">2<sup>é</sup> numéro de téléphone <span
                                class="required">*</span></label>
                        <input minlength="6" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235"
                               value="{{auth()->user()->phones()->skip(1)->first()->number}}"
                               class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                    </div>
                @endif
            @endif
            @if(auth()->user() && auth()->user()->plan_user_id ==3)

                <div class="container-form-email">
                    <label for="phonetwo">2<sup>é</sup> numéro de téléphone</label>

                    <input minlength="6" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                           placeholder="0494827235"
                           @if(auth()->user()->phones()->count() > 1)
                           value="{{auth()->user()->phones()->skip(1)->first()->number}}"
                           @endif class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                </div>
                <div class="container-form-email">
                    <label for="phonethree">3<sup>é</sup> numéro de téléphone</label>

                    <input minlength="6" maxlength="15" type="tel" id="phonethree" pattern="^[0-9-+\s()]*$"
                           placeholder="0494827235"
                           @if(auth()->user()->phones()->count() > 2)
                           value="{{auth()->user()->phones()->skip(2)->first()->number}}"
                           @endif
                           class=" @error('phone') is-invalid @enderror email-label" name="phonethree">
                </div>

            @endif
            @if(!auth())
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif">
                    @endif
                    <div class="container-form-email">
                        <label for="name">Nom du commerce <span class="required">*</span></label>
                        <input type="text" id="name" @if(auth()->user()) value="{{auth()->user()->name}}"
                               @else value="{{old('name')}}"                                @endif placeholder="Rotis"
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
                        <label for="website">Site internet</label>
                        <input placeholder="https://workerz.be" type="text" id="website"
                               @if(auth()->user()) value="{{auth()->user()->website}}" @else                                value="{{old('website')}}"
                               @endif
                               class=" @error('website') is-invalid @enderror email-label" name="website">
                        @if(!auth())
                            @if($plan == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($plan == 2)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($plan == 3)
                                <p class="help">Vous aurez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                            @endif                @endif

                        @error('website')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror

                    </div>
                    @if(auth()->user() && auth()->user()->plan_user_id == 2)

                        @if(auth()->user()->websites()->count() >= 1)
                            <div class="container-form-email">
                                <label for="websitetwo">2<sup>é</sup> site internet <span
                                        class="required">*</span></label>
                                <input type="text" id="websitetwo"
                                       placeholder="http://workerz.be"
                                       @if(auth()->user()->websites()->count() > 1)
                                       value="{{auth()->user()->websites()->first()->number}}"
                                       @endif
                                       class=" @error('phone') is-invalid @enderror email-label" name="websitetwo">
                            </div>
                        @endif
                    @endif
                    @if(auth()->user() && auth()->user()->plan_user_id ==3)

                        <div class="container-form-email">
                            <label for="websitetwo">2<sup>é</sup> site internet</label>

                            <input type="text" id="websitetwo"
                                   placeholder="http://workerz.be"
                                   @if(auth()->user()->websites()->count() > 0)
                                   value="{{auth()->user()->websites()->first()->number}}"
                                   @endif class=" @error('phone') is-invalid @enderror email-label" name="websitetwo">
                        </div>
                        <div class="container-form-email">
                            <label for="websitethree">3<sup>é</sup> site internet</label>

                            <input type="text" id="websitethree"
                                   placeholder="http://workerz.be"
                                   @if(auth()->user()->websites()->count() > 1)
                                   value="{{auth()->user()->websites()->skip(1)->first()->number}}"
                                   @endif
                                   class=" @error('phone') is-invalid @enderror email-label" name="websitethree">
                        </div>

                    @endif
                    @if(!auth())
                </div>
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif container-job-dashboard">
                    @endif
                    <div
                        class="container-form-email @if(auth()->user()) container-edit-formulary @endif container-job-profil selectdiv container-cat">
                        <label for="categoryUser">Catégorie de métier <span class="required">*</span></label>
                        <div class="container-filter-categories container-category">
                            <ul class="list-categories list-checkboxes-register list-dispo-profil">
                                @foreach($categories as $c)
                                    <li>
                                        <input @if(auth()->user() && $user_categories->contains($c->id)) checked @endif role="checkbox"
                                               aria-checked="false" class="checkCat hiddenCheckbox inp-cbx"
                                               name="categoryUser[]" id="categoryUser{{$c->id}}"
                                               type="checkbox" value="{{$c->id}}"/>
                                        <label class="cbx" for="categoryUser{{$c->id}}">
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
                        @error('categoryUser')
                        <div class="@if(!auth()->user())container-error @endif categoerror">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                        @if(!auth()->user())
                            @if($plan == 1)
                                <p class="help proposed-job"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3, je ne trouve pas mon métier, <a
                                            href="{{route('contact'). '#form'}} ">je le propose</a></p>
                            @endif
                            @if($plan == 2)
                                <p class="help proposed-job">Vous avez la possibilité d'en intégrer jusqu'à 2, je ne trouve pas mon métier, <a
                                            href="{{route('contact'). '#form'}} ">je le propose</a></p>
                            @endif
                            @if($plan == 3)
                                <p class="help proposed-job">Vous avez la possibilité d'en intégrer jusqu'à 3, je ne trouve pas mon métier, <a
                                            href="{{route('contact'). '#form'}} ">je le propose</a></p>
                            @endif
                        @endif

                    </div>

                    <div class="container-form-email selectdiv">
                        <label for="disponibilities">Disponibilités</label>
                        <div class="container-filter-categories container-category">
                            <ul class="list-categories list-checkboxes-register list-dispo-profil">
                                @foreach($disponibilities as $disponibility)
                                    <li>
                                        <input
                                            @if(auth()->user() && $user_disponibilities->contains($disponibility->id)) checked
                                            @else                                             @endif @if(!auth()->user() && $disponibility->pre_selected == true) checked
                                            @endif role="checkbox"
                                            aria-checked="false" class=" hiddenCheckbox inp-cbx"
                                            name="disponibilities[]" id="disponibilities{{$disponibility->id}}"
                                            type="checkbox" value="{{$disponibility->id}}"/>
                                        <label class="cbx" for="disponibilities{{$disponibility->id}}">
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
                        @if(!auth()->user())
                            <p class="help">Veuillez séléctionner vos jours d'ouvertures</p>
                        @endif
                    </div>
                    @if(auth()->user() && auth()->user()->plan_user_id ==2)
                        @if(auth()->user()->adresses()->count() >= 1)
                            <div class="container-form-email">
                                <label for="adresstwo">Adresse secondaire</label>
                                <input type="text" id="adresstwo"
                                       class=" @error('adresstwo') is-invalid @enderror email-label"
                                       name="adresstwo"
                                       placeholder="Rue des cocotier, 21" @if(auth()->user()->adresses()->count() > 1)
                                       value="{{auth()->user()->adresses()->first()->postal_adress}}"
                                    @endif>
                            </div>
                            <div class="container-form-email selectdiv">
                                <label for="locationtwo">Région secondaire</label>
                                <select required aria-required="true" class="select-register select-regions"
                                        data-maxoption="1"
                                        name="locationtwo" id="locationtwo">
                                    @if(auth())
                                        <option value="0" disabled selected>-- Votre région --</option>
                                    @endif

                                    @foreach($regions as $region)
                                        <option
                                            @if(auth()->user()->adresses()->count() > 1 && auth()->user()->adresses()->first()->province_id == $region->id) selected
                                            @endif value="{{$region->id}}">{{$region->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endif

                    @if(auth()->user() && auth()->user()->plan_user_id == 3)
                        <div class="container-form-email">
                            <label for="adresstwo">Adresse secondaire</label>
                            <input type="text" id="adresstwo"
                                   class=" @error('adresstwo') is-invalid @enderror email-label" name="adresstwo"
                                   placeholder="Rue des cocotier, 21"
                                   @if(auth()->user()->adresses()->count() > 1) value="{{auth()->user()->adresses()->skip(1)->first()->postal_adress}}"
                                @endif>
                        </div>
                        <div class="container-form-email selectdiv">
                            <label for="locationtwo">Région secondaire</label>
                            <select required aria-required="true" class="select-register select-regions"
                                    data-maxoption="1"
                                    name="locationtwo" id="locationtwo">
                                @if(auth()->user())
                                    <option value="0" disabled selected>-- Votre région --</option>
                                @endif
                                @foreach($regions as $region)
                                    <option
                                        @if(auth()->user()->adresses()->count() > 1 && auth()->user()->adresses()->skip(1)->first()->province_id == $region->id) selected
                                        @endif value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container-form-email">
                            <label for="adressthree">Adresse tertiaire</label>
                            <input type="text" id="adressthree"
                                   @if(auth()->user()->adresses()->count() > 2)
                                   value="{{auth()->user()->adresses()->skip(2)->first()->postal_adress}}"
                                   @endif
                                   class=" @error('adressthree') is-invalid @enderror email-label" name="adressthree"
                                   placeholder="Rue des cocotier, 21">
                        </div>
                        <div class="container-form-email selectdiv">
                            <label for="locationthree">Région tertiaire</label>
                            <select required aria-required="true" class="select-register select-regions"
                                    data-maxoption="1"
                                    name="locationthree" id="locationthree">
                                @if(auth()->user())
                                    <option value="0" disabled selected>-- Votre région --</option>
                                @endif
                                @foreach($regions as $region)
                                    <option
                                        @if(auth()->user()->adresses()->count() > 2 && auth()->user()->adresses()->skip(2)->first()->province_id == $region->id) selected
                                        @endif value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="container-form-email container-job-dashboard">
                        <label for="job">Metier <span class="required">*</span></label>
                        <input type="text" id="job" @if(auth()->user()) value="{{auth()->user()->job}}"
                               @else value="{{old("job")}}" @endif
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


                    @if(!auth())
                </div>
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif">
                    @endif

                    <div class="container-form-email">
                        <label for="pricemax">Votre prix horaire</label>
                        <input max="999999" type="text" id="pricemax" pattern="^[0-9-+\s()]*$" name="pricemax"
                               @if(auth()->user()) value="{{auth()->user()->pricemax}}"
                               @else  value="{{old('pricemax')}}"
                               @endif class=" @error('pricemax') is-invalid @enderror email-label"
                               placeholder="55"><span
                            class="horary-cost horary-cost-company">€/h</span>
                        @if(!auth()->user())

                            <p class="help">Ce prix donne un aperçu au client</p>
                        @endif

                        @error('pricemax')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>


                    @if(!auth())
                </div>

                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif">
                    @endif
                    @if(!auth())
                        <div class="container-form-email selectdiv">
                            <label for="location">Région <span class="required">*</span></label>
                            <select required aria-required="true" class="select-register select-regions"
                                    data-maxoption="1"
                                    name="location" id="location">
                                @if(!auth())
                                    <option value="0" disabled selected>-- Votre région --</option>
                                @endif
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                            @error('location')
                            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                            @if(!auth())
                                @if($plan == 1)
                                    <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                        vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                                @endif
                                @if($plan == 2)
                                    <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 2 via votre
                                        profil</p>
                                @endif
                                @if($plan == 3)
                                    <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 3 via votre
                                        profil</p>
                                @endif
                            @endif

                        </div>
                    @endif

                    <div class="container-form-email container-job-dashboard">
                        <label for="adress">Adresse du siège social <span class="required">*</span></label>
                        <input type="text" id="adress"
                               @if(auth()->user()) value="{{auth()->user()->adresses()->first()->postal_adress}}"
                               @else value="{{old("adress")}}" @endif
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
                        <label for="catchPhrase">Phrase d'accroche</label>
                        <input type="text" id="catchPhrase"
                               class="email-label" name="catchPhrase"
                               placeholder="Une entreprise qui vous satisfera"
                               @if(auth()->user()) value="{{auth()->user()->catchPhrase}}"
                               @else  value="{{old("catchPhrase")}}" @endif>
                        @if(!auth()->user())
                            <p class="help">
                                Attirer la clientèle à votre façon (optionnel)
                            </p>
                        @endif
                    </div>

                    <div class="container-form-email selectdiv">
                        <label for="location">Région <span class="required">*</span></label>
                        <select required aria-required="true" class="select-register select-regions" data-maxoption="1"
                                name="location" id="location">
                            @if(!auth()->user())
                                <option value="0" disabled selected>-- Votre région --</option>
                            @endif
                            @foreach($regions as $region)
                                <option
                                     @if(auth()->user() && auth()->user()->adresses->first()->province_id == $region->id) selected @else @endif value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                        @error('location')
                        <div class="container-error categoerror">
                <span role="alert" class="error">
                    <strong>{{ ucfirst($message) }}</strong>
                </span>
                        </div>
                        @enderror
                        @if(!auth()->user())
                            @if($plan == 1)
                                <p class="help"><a href="{{route('users.plans')}}#plans">Augmenter votre plan</a> et
                                    vous aurez la possibilité d'en ajouter jusqu'à 3</p>
                            @endif
                            @if($plan == 2)
                                <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 2 via votre profil</p>
                            @endif
                            @if($plan == 3)
                                <p class="help">Vous avez la possibilité d'en intégrer jusqu'à 3 via votre profil</p>
                            @endif
                        @endif
                    </div>
                    <div class="container-form-email">
                        <span>Possibilités d'emplois dans l'entreprise</span>
                        <ul id="jobOpportunity">
                            <li>
                                <input role="radio" class="hiddenRadio inp-cbx"
                                       id="jobOpportunityYes"
                                       name="possibility_job"
                                       @if(!auth()->user()) aria-checked="false"  @endif
                                       @if(auth()->user() && auth()->user()->possibility_job == 'yes') checked
                                       @endif type="radio" value="yes"/>
                                <label class="cbx" for="jobOpportunityYes">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span class="jobOpportunity">Oui</span>
                                </label>
                            </li>
                            <li>
                                <input role="radio"
                                       class="hiddenRadio inp-cbx"
                                       id="jobOpportunityNo"
                                       @if(!auth()->user()) aria-checked="false"  @endif
                                       @if(auth()->user() && auth()->user()->possibility_job == 'no') checked
                                       @else aria-checked="false" @endif name="possibility_job"
                                       type="radio" value="no"/>
                                <label class="cbx" for="jobOpportunityNo">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span class="jobOpportunity">Non</span>
                                </label>
                            </li>
                            <li>
                                <input role="radio"
                                       class="hiddenRadio inp-cbx"
                                       id="jobOpportunityNotDetermine"
                                       @if(auth()->user() && auth()->user()->possibility_job == 'dkn') checked @endif
                                       @if(!auth()->user()) aria-checked="true" checked
                                       @endif name="possibility_job"
                                       type="radio" value="dkn"/>
                                <label class="cbx" for="jobOpportunityNotDetermine">
                                <span>
                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                      <polyline points="1 5 4 8 11 1"></polyline>
                                    </svg>
                                </span>
                                    <span class="jobOpportunity">Non déterminer</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    @if(!auth())
                </div>
                <div
                    class="container-register-form container-register @if(auth()->user()) container-edit-formulary @endif contaner-description">
                    @endif
                    <div class="container-form-email container-description-register">
                        <div class="container-maxCharacters">
                            <label for="description">Description <span class="required">*</span></label>
                            <span class="maxCharacters">256 caractères max</span>
                        </div>
                        @if(auth()->user() && auth()->user()->description)
                            <textarea id="description" maxlength="256" name="description" required
                                      class=" @error('description') is-invalid @enderror email-label"
                                      placeholder="Description détailée de votre profil..."
                                      rows="5" cols="33">{{auth()->user()->description}}</textarea>
                        @else
                            <textarea id="description" maxlength="256" name="description" required
                                       class=" @error('description') is-invalid @enderror email-label"
                                      placeholder="Description détailée de votre profil..."
                                      rows="5" cols="33">{{old("description")}}</textarea>
                        @endif
                        @error('description')
                        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                        </div>
                        @enderror
                    </div>
                    @if(!auth())
                </div>
            @endif
            @include('partials.register')
            @if(auth()->user())
                <div class="container-form-email">
                    <label for="facebook">Lien Facebook</label>
                    <input placeholder="https://facebook.be" type="text" id="facebook"
                           @if(auth()->user()) value="{{auth()->user()->facebook}}" @endif
                           class=" @error('facebook') is-invalid @enderror email-label" name="facebook">

                    @error('facebook')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="instagram">Lien Instagram</label>
                    <input placeholder="https://instagram.be" type="text" id="instagram"
                           @if(auth()->user()) value="{{auth()->user()->instagram}}" @endif
                           class=" @error('instagram') is-invalid @enderror email-label" name="instagram">

                    @error('instagram')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="linkedin">Lien Linkedin</label>
                    <input placeholder="https://linkedin.be" type="text" id="linkedin"
                           @if(auth()->user()) value="{{auth()->user()->linkedin}}" @endif
                           class=" @error('linkedin') is-invalid @enderror email-label" name="linkedin">

                    @error('linkedin')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="twitter">Lien twitter</label>
                    <input placeholder="https://twitter.be" type="text" id="twitter"
                           @if(auth()->user()) value="{{auth()->user()->twitter}}" @endif
                           class=" @error('twitter') is-invalid @enderror email-label" name="twitter">

                    @error('twitter')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
            @endif
            <div class="button-save-company">
                @if(!\Illuminate\Support\Facades\Auth::user())
                    <input id="role_id" name="role_id" type="hidden" value="2">
                    <input id="plan_user_id{{$plan}}" name="plan_user_id" type="hidden" value="{{$plan}}">
                    <input id="plan{{$plan}}" name="plan" type="hidden" value="{{$plan}}">
                    <input id="type" name="type" type="hidden" value="company">
                    <input type="hidden" name="type" value="company">
                    <button role="button" class="button-cta" name="company" type="submit">
                        Finaliser l'inscription
                    </button>
                @else
                    <button role="button" class="button-cta" name="company" type="submit">
                        Sauvegarder mes informations
                    </button>
                @endif

            </div>
        </div>

    </form>
</div>
