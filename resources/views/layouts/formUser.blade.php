<div>
    <form class="form-login form-register @if(!auth()->user())container-register-user @endif"
          enctype="multipart/form-data"
          aria-label="Enregistrement d'un compte" role="form" method="POST"
          @auth action="{{ route('dashboard.update') }}" @elseauth action="{{ route('register') }}" @endauth>
        @csrf
        @auth
            @method('PUT')
        @endauth
        @if(auth()->user())
            <div class="container-register-form container-register">
                @endif
                <div class="container-form-email">
                    <div class="avatar-container @if(auth()->user()) avatar-dashboard-profil @endif">
                        <label for="picture">Photo de profil</label>
                        <img @if(auth()->user() && auth()->user()->picture !== null) src="{{asset(auth()->user()->picture)}}" @elseif(auth()->user() && auth()->user()->picture == null) src="{{asset('svg/user.svg')}}" @endif width="150" height="150" id="output" class="preview-picture preview-edit" alt="photo du commerce"/>
                    </div>
                    <input type="file"
                           id="picture" class="input-field @error('picture') is-invalid @enderror email-label"
                           name="picture"
                           accept="image/png, image/jpeg">
                    <p class="help helppicture">Format acceptés : jpg, png, jpeg ou svg</p>
                    <p class="helpSecond helppicture">Poid maximum : 2048KO</p>
                    @error('picture')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>

                <div class="container-form-email container-phone">
                    <label for="number">Numéro de téléphone <span class="required">*</span></label>

                    <input minlength="6" maxlength="15" type="tel" id="number" pattern="^[0-9-+\s()]*$"
                           @if(auth()->user()) value="{{auth()->user()->phones()->first()->number}}"
                           @else value="{{old('number')}}"
                           @endif placeholder="0494827235"
                           class=" @error('number') is-invalid @enderror email-label" name="number" required
                           aria-required="true">
                    @error('number')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                    @if(!auth()->user())
                        @if($plan == 1)
                            <p class="help"><a href="{{route('users.plans')}}#plans">Augmentez votre plan</a> et
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
                        <label for="phonetwo">2<sup>é</sup> Numéro de téléphone</label>
                        <input minlength="6" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235" value="{{auth()->user()->phones()->skip(1)->first()->number}}"

                               class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                    @endif
                @endif
                @if(auth()->user() && auth()->user()->plan_user_id ==3)
                    <div class="container-form-email">
                        <label for="phonetwo">2<sup>é</sup> Numéro de téléphone</label>
                        <input minlength="6" maxlength="15" type="tel" id="phonetwo" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235"
                               @if(auth()->user()->phones()->count() > 1)
                               value="{{auth()->user()->phones()->skip(1)->first()->number}}"
                               @endif class=" @error('phone') is-invalid @enderror email-label" name="phonetwo">
                    </div>
                    <div class="container-form-email">
                        <label for="phonethree">3<sup>é</sup> Numéro de téléphone</label>
                        <input minlength="6" maxlength="15" type="tel" id="phonethree" pattern="^[0-9-+\s()]*$"
                               placeholder="0494827235"
                               @if(auth()->user()->phones()->count() > 2)
                               value="{{auth()->user()->phones()->skip(2)->first()->number}}"
                               @endif
                               class=" @error('phone') is-invalid @enderror email-label" name="phonethree">
                    </div>
                @endif
                @if(auth()->user())
            </div>
        @endif

        @if(auth()->user())
            <div class="container-register-form container-register container-edit-name">
                @endif
                <div class="container-form-email">
                    <label for="name">Nom<span class="required"> *</span></label>
                    <input type="text" id="name" @if(auth()->user()) value="{{auth()->user()->name}}"
                           @else value="{{old('name')}}"
                           @endif placeholder="Rotis"
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
                    <label for="surname">Prénom</label>
                    <input type="text" id="surname" placeholder="Daniel"
                           @if(auth()->user()) value="{{auth()->user()->surname}}"
                           @else value="{{old('surname')}}"
                           @endif
                           class=" @error('surname') is-invalid @enderror email-label" name="surname">
                </div>

                @if(auth()->user())
            </div>
            <div class="container-connexion-logins">
                @endif
                @include('partials.register')
                @if(auth()->user())
            </div>
        @endif

        <div>
            @if(!\Illuminate\Support\Facades\Auth::user())
                <input id="role_id" name="role_id" type="hidden" value="3">
                <input id="plan_user_id" name="plan_user_id" type="hidden" value="{{$plan}}">
                <input id="plan{{ $plan }}" name="plan" type="hidden" value="{{$plan}}">
                <input type="hidden" name="type" value="user">
                <button role="button" class="button-cta" name="user" type="submit">
                    Finaliser l'inscription
                </button>
            @else
                <button role="button" class="button-cta" name="user" type="submit">
                    Sauvegarder mes informations
                </button>
            @endif
        </div>
    </form>
</div>
@auth
@section('scripts')
    @if(auth()->user()->plan_user_id !== 1)
    <script>function confirmDelete(e){return!0===confirm("Le paiement ne sera pas rembourser, êtes vous sûr de changer de plan ?")||(e.preventDefault(),!1)}
        document.getElementById('changePlan').addEventListener("click",confirmDelete)</script>
    @endif
    <script src="{{asset('js/passwordCheck.js')}}"></script>
    <script src="{{asset('js/passwordSee.js')}}"></script>
    <script src="{{asset('js/previewPicture.js')}}"></script>
    @if(auth()->user()->plan_user_id == 1)
        <script src="{{asset('js/checkDataMaxOptions.js')}}"></script>
    @endif
    @if(auth()->user()->plan_user_id == 2)
        <script src="{{asset('js/checkDataMaxOptions2.js')}}"></script>
    @endif
    @if(auth()->user()->plan_user_id == 3)
        <script src="{{asset('js/checkDataMaxOptions3.js')}}"></script>
    @endif
@endsection
@endauth
