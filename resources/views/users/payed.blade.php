@extends('layouts.app')
@section('content')
    @if (Session::has('success-users'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('success-users')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <section class="container-home margin">
        <div class="container-home_image container-home-create container-home-page">
            <div>
                <div class="container-home-text">
                    <h2 aria-level="2">
                        Finalisons l'achat ensemble
                    </h2>
                    <p>
                        Votre inscription sera valable après ce passage
                    </p>
                </div>
            </div>
            <div class="container-svg">
                <img width="300" height="300"src="{{asset('svg/Card Payment_Monochromatic.svg')}}"
                     alt="icone de carte">
            </div>
        </div>
    </section>
    <section class="container-home container-announcements container-create-ads">
        <div class="title-first-step-register">
            <h2 aria-level="2" class="hidden">Plan sélectionné pour votre inscription</h2>
        </div>
        <div class="container-home container-home_image container-paied">
            <section>
                <div class="container-connexion container-plan-paied">
                    <h3 aria-level="3">Plan sélectionné</h3>
                    <div class="container-all-announcement show-content container-create-ads-infos container-plans">
                        <section
                            class="container-plan container-payed-plan @if($plan->id === 2) container-hot-plan @endif">
                            <div class="container-plan-price">
                                <h4 aria-level="4">
                                    {{ucfirst($plan->name)}}
                                </h4>
                                <span class="planPrice">
                                     {{number_format((float)$plan->price, 2, ',', '')}} €
                                </span>
                                @if($plan->price != 0)
                                    <span class="planPrice monthCost">
                                         ({{number_format((float) 1 * ($plan->price/$plan->duration) * 30 , 2, ',', '')}} € / mois)
                                    </span>
                                @endif
                                @if($plan->oldprice)
                                    <p class="reductionPrice">
                                        {{$plan->oldprice}} €
                                    </p>
                                @endif
                            </div>
                            <ul>
                                <li>
                                    <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">Durée : @if($plan->id == 1) {{$plan->duration}} jours @else {{$plan->duration / 30}} mois @endif
                                </li>
                                <li>
                                    <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">
                                    @if($plan->id == 1) Support basique @elseif($plan->id == 2) Support intermédiaire @elseif($plan->id == 3) Support prioritaire @endif
                                </li>
                                <li class="container-visibility">
                                    @if($plan->more_visible) <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct"> @else
                                        <img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="Icone négative"> @endif
                                    @if($plan->id == 1)
                                        Forte visibilité
                                    @endif
                                    @if($plan->id == 2)
                                        Votre entreprise sera visible {{$plan->id * 3}} fois plus souvent
                                    @endif
                                    @if($plan->id == 3)
                                        Votre entreprise sera visible {{$plan->id * 5}} fois plus souvent
                                    @endif *
                                </li>
                                <li class="container-visibility">
                                    <img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="Icone correct">@if($plan->id == 1)  Visible parmis les 100 premiers @elseif($plan->id == 2)  Visible parmis les premiers 15 premiers @elseif($plan->id == 3)  Visible parmis les 4 premiers @endif *
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </section>
            <section class="container-price-paied">
                <div>
                    <h3 aria-level="3">Le montant s'éleve à
                        {{number_format((float)$plan->price, 2, ',', '')}} € </h3>
                    <p>Saisissez les informations relatives à votre carte de crédit</p>
                    <form class="form-login form-register show-content" enctype="multipart/form-data"
                          aria-label="Payement pour l'enregistrement d'un compte" role="form" method="post" id="payment-form"
                          action="{{ route('users.paied') }}">
                        @csrf
                        <div class="container-form-email">
                            <label class="hidden" for="payed-info"
                            >Informations de paiement</label>
                            <div id="card-element" class=" email-label">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <div id="card-errors" role="alert"></div>

                            @error('payed-info')
                            <div class="container-error">
                                    <span role="alert" class="error">
                                        <strong>{{ ucfirst($message) }}</strong>
                                    </span>
                            </div>
                            @enderror
                        </div>
                        <div>
                            <input type="hidden" name="plan" @if(auth()->user()->sending_time_expire = 1 && auth()->user()) value="{{$plan->id}}" @else value="{{old('plan', $plan)}}" @endif>
                            <button
                                id="card-button"
                                class="button-cta"
                                type="submit"
                                data-secret="{{ $intent }}" role="button" name="is_payed">
                                Finaliser mon achat
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        const stripe = Stripe('{{ $stripe_key }}', {locale: 'fr'}); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', {style: style}); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.handleCardPayment(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                }
            })
                .then(function (result) {
                    console.log(result);
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        console.log(result);
                        form.submit();
                    }
                });
        });
    </script>
@endsection
