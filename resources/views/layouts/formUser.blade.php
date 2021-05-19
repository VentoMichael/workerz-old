<div>
    <form class="form-login form-register" enctype="multipart/form-data"
          aria-label="Enregistrement d'un compte" role="form" method="POST"
          @auth action="{{ route('dashboard.update') }}" @elseauth action="{{ route('register') }}" @endauth>
        @csrf
        @auth @method('PUT') @endauth
        <div class="container-register-form container-register">
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
                       @auth value="{{auth()->user()->phones()->first()->number}}" @elseauth value="{{old('phone')}}"
                       @endauth placeholder="0494827235"
                       class=" @error('phone') is-invalid @enderror email-label" name="phone" required
                       aria-required="true">
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
                @error('phone')
                <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                </div>
                @enderror
            </div>
        </div>
        <div class="container-register-form container-register">
            <div class="container-form-email">
                <label for="name">Nom<span class="required"> *</span></label>
                <input type="text" id="name" @auth value="{{auth()->user()->name}}" @elseauth value="{{old('name')}}"
                       @endauth placeholder="Rotis"
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
                <label for="surname">Prénom<span class="required"> *</span></label>
                <input type="text" id="surname" placeholder="Daniel" @auth value="{{auth()->user()->surname}}"
                       @elseauth value="{{old('surname')}}"
                       @endauth
                       class=" @error('surname') is-invalid @enderror email-label" name="surname" required
                       aria-required="true">
            </div>

        </div>
        @include('partials.register')
        <div>
            @if(!\Illuminate\Support\Facades\Auth::user())
                <input id="role_id" name="role_id" type="hidden" value="3">
                <input id="plan_user_id" name="plan_user_id" type="hidden" value="{{$plan}}">
                <input id="plan{{ $plan }}" name="plan" type="hidden" value="{{$plan}}">
                <input type="hidden" name="type" value="user">
            @endif
            <button role="button" class="button-cta" name="user" type="submit">
                Finaliser l'inscription
            </button>
        </div>
    </form>
</div>
