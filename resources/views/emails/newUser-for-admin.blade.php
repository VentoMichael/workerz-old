@component('mail::message')
# Un nouvel utilisateur s'est inscrit !

## C'est un utilisateur de role @if($user->role["name"]) utilisateur | "je recherche une entreprise" @else entreprise | "je suis une entreprise" @endif, avec un plan de niveau {{$user->plan_user['name']}}

### Nom :
{{$user["name"]}}


@component('mail::button',['url' => env('APP_URL').'/nova'])
Allez dans le dashboard
@endcomponent

@endcomponent
