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
    <div>Veuillez confirmer l'accès à votre compte en saisissant le code d'authentification fourni par votre application d'authentification.
    </div>

    <div>
        <label for="code">Code</label>
        <input type="text" name="code" id="code" autofocus autocomplete="one-time-code" />
    </div>
    <div>Veuillez confirmer l'accès à votre compte en saisissant l'un de vos codes de récupération d'urgence.
    </div>

    <div>
        <label for="recovery_code">Code de récupération</label>
        <input type="text" name="recovery_code" id="recovery_code" autocomplete="one-time-code" />
    </div>

    <div>
        <button type="submit">
            Connexion
        </button>
    </div>
</form>
