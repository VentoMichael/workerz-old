<section class="container-categories-home margin container-message" id="form">
    <div class="container-categories-text-home">
        <h2 aria-level="2">
            Formulaire de contact
        </h2>
        <p>Il n'y a pas de mauvaises questions, la réponse sera presque imminente !</p>
    </div>
    <div id="createMsg">
        @if (Session::has('success-send'))
            <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
                <p>{{Session::get('success-send')}}</p>
                <span class="crossHide" id="crossHide">&times;</span>
            </div>
        @endif

        <form wire:submit.prevent="register" class="show-content form-login form-register form-message"
              aria-label="Envoi d'un message" role="form" method="POST"
              action="{{ route('contact.store') }}">
            @csrf
            <div class="container-register-form">
                <div class="container-form-email">
                    <label for="name">Nom <span class="required">*</span></label>
                    <input wire:model="name" type="text" id="name"
                           @if(\Illuminate\Support\Facades\Auth::check()) value="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                           @else value="{{ old('name') }}" @endif placeholder="Rotis"
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
                    <input wire:model="surname" type="text" id="surname"
                           @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->surname !== null) value="{{\Illuminate\Support\Facades\Auth::user()->surname}}"
                           @else value="{{ old('surname') }}" @endif placeholder="Daniel"
                           class=" @error('surname') is-invalid @enderror email-label" name="surname">
                </div>
            </div>

            <div class="container-register-form">
                <div class="container-form-email">
                    <label for="email">Email <span class="required">*</span></label>
                    <input wire:model="email" id="email" type="email"
                           class=" @error('email') is-invalid @enderror email-label"
                           name="email"
                           value="@if(\Illuminate\Support\Facades\Auth::check()) {{\Illuminate\Support\Facades\Auth::user()->email}} @else {{ old('email') }} @endif"
                           placeholder="danielrotis@gmail.com" required aria-required="true" autocomplete="email">
                    @error('email')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
                <div class="container-form-email">
                    <label for="subject">Sujet <span class="required">*</span></label>
                    <input wire:model="subject" type="text" placeholder="Engagez un menuisier" id="subject" value="{{old("subject")}}"
                           class=" @error('subject') is-invalid @enderror email-label" name="subject" required
                           aria-required="true">
                    @error('subject')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="container-register-form container-textarea">
                <div class="container-form-email">
                    <label for="message">Message <span class="required">*</span></label>
                    <textarea wire:model="message" id="message" name="message" required aria-required="true"
                              class=" @error('message') is-invalid @enderror email-label"
                              placeholder="Message eventuel..."
                              rows="5" cols="33">{{old("message")}}</textarea>
                    @error('message')
                    <div class="container-error">
                <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                    </div>
                    @enderror
                </div>
            </div>
            <div>
                <button role="button" class="button-cta" type="submit">
                    Envoyer un message
                </button>
            </div>
        </form>
    </div>
</section>