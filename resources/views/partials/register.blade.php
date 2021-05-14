<div class="container-register-form container-inscriptin-logins">
    <div class="container-form-email">
        <label for="email">Email</label>
        <input id="email" type="email"
               class=" @error('email') is-invalid @enderror email-label"
               name="email"
               value="{{ old('email') }}" placeholder="danielrotis@gmail.com" required aria-required="true" autocomplete="email">
        @error('email')
        <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
        </div>
        @enderror
    </div>
    <div>
        <label for="password"
        >Mot de passe</label>
        <div class="@error('password')is-invalid @enderror password">
            <div id="container-checkpass" class="container-checkpass">
                <label for="checkPass" class="hidden">Voir/masquer le mot de passe</label>
                <input type="checkbox" class="password--visibleToggle" id="checkPass" checked>
                <div class="password--visibleToggle-eye open">
                    <img src="{{asset('svg/eye-open.svg')}}" alt="icone de yeux ouvert"/>
                </div>
                <div class="password--visibleToggle-eye close">
                    <img src="{{asset('svg/eye-close.svg')}}" alt="icone de yeux fermé"/>
                </div>
            </div>

            <input id="password" type="password" placeholder="Xxxxxxx1"
                   class="password--input"
                   name="password" required aria-required="true">

        </div>
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
</div>

@error('password')
<div class="container-error">
                                    <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
</div>
@enderror
<div>
    <input type="hidden" name="type" value="{{$type}}">
    <button role="button" class="button-cta" type="submit">
        Finaliser l'inscription
    </button>
</div>
