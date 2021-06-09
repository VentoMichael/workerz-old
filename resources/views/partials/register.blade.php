@if(!auth()->user())
    <div class="container-register-form container-inscriptin-logins container-register container-description-register">
        @endif
        <div class="container-form-email">
            <label for="email">@if(auth()->user()) Nouveau email @else Email @endif <span
                    class="required"> *</span></label>
            <input id="email" type="email"
                   class=" @error('email') is-invalid @enderror email-label"
                   name="email"
                   @if(auth()->user()) value="{{ auth()->user()->email }}" @else value="{{ old('email') }}"
                   @endif placeholder="danielrotis@gmail.com" required aria-required="true" autocomplete="email">
            @error('email')
            <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
            </div>
            @enderror
        </div>
        <div class="container-password">
            <label for="password"> @if(auth()->user()) Nouveau mot de passe @else Mot de passe <span
                    class="required"> *</span> @endif </label>
            <div class="@error('password')is-invalid @enderror password">
                <div id="container-checkpass" class="container-checkpass">
                    <label for="checkPass" class="hidden">Voir/masquer le mot de passe</label>
                    <input tabindex="1" type="checkbox" class="password--visibleToggle" id="checkPass" checked>
                    <div class="password--visibleToggle-eye password--visibleToggle-eye-register open">
                        <img src="{{asset('svg/eye-open.svg')}}" alt="icone de yeux ouvert"/>
                    </div>
                    <div class="password--visibleToggle-eye password--visibleToggle-eye-register close">
                        <img src="{{asset('svg/eye-close.svg')}}" alt="icone de yeux fermé"/>
                    </div>
                </div>

                <input id="password" type="password" placeholder="Xxxxxxx1"
                       class="password--input"
                       name="password" @if(!auth()->user()) required aria-required="true" @endif>

            </div>
            @error('password')
            <div>
                                    <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
            </div>
            @enderror
            <ul role="list" class="list-password-required">
                <li id="cara">
                    <img src="{{asset('../svg/good.svg')}}" alt="good icon">
                    <p role="listitem">
                        <span>&bull;</span> 8 caractères
                    </p>
                </li>
                <li id="maj">
                    <img src="{{asset('../svg/good.svg')}}" alt="good icon">
                    <p role="listitem">
                        <span>&bull;</span> 1 majuscule
                    </p>
                </li>
                <li id="symbole">
                    <img src="{{asset('../svg/good.svg')}}" alt="good icon">
                    <p role="listitem">
                        <span>&bull;</span> 1 chiffre
                    </p>
                </li>
            </ul>
        </div>

        @if(!auth()->user())
    </div>
    <div class="condition-newsletter-container">
        <div style="position: relative">
            <input role="checkbox"
                   aria-checked="false" class="hiddenCheckbox inp-cbx"
                   name="newslettersignin" id="newslettersignin"
                   type="checkbox" checked value="1"/>
            <label class="cbx" for="newslettersignin">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                <span> Je souhaite m'inscrire à la newsletter</span>
            </label>
        </div>
        <div style="position: relative">
                <input role="checkbox"
                    aria-checked="false" class="hiddenCheckbox inp-cbx"
                    name="conditions" id="conditions"
                    type="checkbox" value="1"/>
                <label class="cbx" for="conditions">
                                                <span>
                                                    <svg width="12px" height="9px" viewbox="0 0 12 9">
                                                      <polyline points="1 5 4 8 11 1"></polyline>
                                                    </svg>
                                                </span>
                    <span>
                                                   Je suis en accord avec les <a href="{{route('conditions')}}">conditions d’utilisations</a> et la <a href="{{route('policy')}}">politique de confidentialité</a> du site
                                                </span>
                </label>
        </div>
        @error('conditions')
        <div>
                                    <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
        </div>
        @enderror
    </div>
@endif

