@if ($errors->any())
    <div>
        <div>Oups&nbsp;! Un problème est survenu&nbsp;!</div>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form aria-label="Double facteur" method="POST" action="{{ url('/two-factor-challenge') }}">
    @csrf

    {{--
        Do not show both of these fields, together. It's recommended
        that you only show one field at a time and use some logic
        to toggle the visibility of each field
    --}}

    <div>Veuillez confirmer l'accès à votre compte en saisissant le code d'authentification fourni par votre application d'authentification.
    </div>

    <div>
        <label>Code</label>
        <input type="text" name="code" autofocus autocomplete="one-time-code" />
    </div>

    {{-- ** OR ** --}}

    <div>Veuillez confirmer l'accès à votre compte en saisissant l'un de vos codes de récupération d'urgence.
    </div>

    <div>
        <label>Code de récupération</label>
        <input type="text" name="recovery_code" autocomplete="one-time-code" />
    </div>

    <div>
        <button type="submit">
            Connexion
        </button>
    </div>
</form>
