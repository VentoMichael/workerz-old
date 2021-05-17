@component('mail::message')
# Nouveau message de {{$data["name"]}} via le formulaire de contact

## Nom :
{{$data["name"]}}

<br />

___

<br />

### Sujet :

{{$data["subject"]}}

___

<br />

### Message :

{{$data["message"]}}


@component('mail::button',['url' => env('APP_URL').'/nova'])
Voir dans le dashboard
@endcomponent

@endcomponent
