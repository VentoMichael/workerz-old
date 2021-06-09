<div class="container-register-form container-register">
    <div class="container-form-email">
        <label for="catchPhrase">Phrase d'accroche</label>
        <input type="text" id="catchPhrase"
               @if(auth()->user()) value="{{$announcement->catchPhrase}}"
               @else value="{{old("catchPhrase")}}" @endif
               class="email-label" name="catchPhrase"
               placeholder="Une entreprise qui vous satisfera">
        <p class="help informations">
            Attirer la clientèle à votre façon (optionnel)
        </p>
    </div>
    <div class="container-form-email">
        <div class="avatar-container">
            <label for="picture">Photo de profil</label>
            <img width="150" height="150" id="output" class="preview-picture" alt="photo du commerce"/>
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
    <div class="container-form-email category-input container-title-ad">
        <label for="title">Titre <span class="required">*</span></label>
        <input type="text" id="title" @if(auth()->user()) value="{{$announcement->title}}"
               @else value="{{old("title")}}" @endif
               class=" @error('title') is-invalid @enderror email-label" name="title"
               required aria-required="true" placeholder="Menuisier dans liège">
        @error('title')
        <p class="danger help">
            {{$errors->first('title')}}
        </p>
        @enderror
    </div>
    <div class="container-form-email container-email-form category-input container-title-ad">
        <label for="location">Région <span class="required">*</span></label>
        <select required aria-required="true" class="select-register select-regions"
                data-maxoption="1" name="location" id="location">
            <option value="0" disabled selected>-- Votre région --</option>
            @foreach($regions as $region)
                <option
                    @if(auth()->user() && $announcement->province_id == $region->id) selected
                    @endif value="{{$region->id}}">{{$region->name}}</option>
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
               id="job" @if(auth()->user()) value="{{$announcement->job}}"
               @else value="{{old("job")}}" @endif
               class=" @error('job') is-invalid @enderror email-label" name="job" required
               aria-required="true">
        @error('job')
        <p class="danger help">
            {{$errors->first('job')}}
        </p>
        @enderror
    </div>
    <div class="container-form-email category-input container-title-ad">

        <label for="categoryAds">Catégorie de métier <span class="required">*</span></label>
        <div class="container-filter-categories container-category">
            <ul class="list-categories">
                @foreach($categories as $c)
                    <li>
                        <input role="checkbox"
                               @if(auth()->user() && $announcement_categories->contains($c->id)) checked
                               @endif aria-checked="false"
                               class="checkCat hiddenCheckbox inp-cbx" name="categoryAds[]"
                               id="categoryAds{{$c->id}}" type="checkbox"
                               value="{{$c->id}}"/> <label class="cbx"
                                                           for="categoryAds{{$c->id}}">
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
            <p class="help informations"><a href="{{route('announcements.plans')}}#plans">Augmenter votre
                    plan</a> et
                vous aurez la possibilité d'en ajouter jusqu'à 3</p>
        @endif
        @if($plan == 2)
            <p class="help informations">Vous avez la possibilité d'en intégrer jusqu'à 2</p>
        @endif
        @if($plan == 3)
            <p class="help informations">Vous avez la possibilité d'en intégrer jusqu'à 3</p>
        @endif


    </div>
</div>

<div class="container-register-form container-register @if(!auth()->user()) container-job-ads-create @endif">
    <div class="container-form-email">
        <label for="pricemax">Combien voulez vous dépensez au maximum&nbsp;?</label>
        <input max="999999" type="text" pattern="^[0-9-+\s()]*$" id="pricemax"
               name="pricemax"
               @if(auth()->user()) value="{{$announcement->pricemax}}"
               @else value="{{old("pricemax")}}" @endif
               class="email-label" maxlength="999999" placeholder="500"><span
            class="horary-cost">€</span>
        @error('pricemax')
        <p class="danger dangerCategory" style="font-size: .8em;position: absolute;bottom: -6px;">
            {{$errors->first('pricemax')}}
        </p>
        @enderror
        <p class="help hepl-price informations">
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
                               @if(auth()->user() && $announcement->start_month_id == $disponibility->id) checked
                               @endif aria-checked="false"
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
        <p class="help informations">Vous avez la possibilité d'en ajouter qu'un seul</p>

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
                  rows="5" cols="33">@if(auth()->user()){{$announcement->description}} @else{{old("description")}} @endif</textarea>
        @error('description')
        <p class="danger help">
            {{$errors->first('description')}}
        </p>
        @enderror
    </div>
</div>
<div class="container-draft-publish-dashboard container-btn-draft">
    @if($announcement->is_draft === 1)
    <div class="link-back">
        <button class="button-back button-cta button-draft" name="publish">
            Je la poste
        </button>
    </div>
    @endif
    <div class="container-buttons-ads btn-save-dashboard">
        <button role="button" class="button-cta" type="submit">
            Je sauvegarde les données
        </button>
    </div>
</div>
