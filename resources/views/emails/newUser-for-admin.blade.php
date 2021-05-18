@component('mail::message')
# Un nouvel utilisateur s'est inscrit !

## C'est un utilisateur de role {{$user["role_id"]}}, avec un plan de niveau {{$user['plan_user_id']}}

### Nom :
{{$user["name"]}}


@component('mail::button',['url' => env('APP_URL').'/nova'])
Allez dans le dashboard
@endcomponent

@endcomponent
