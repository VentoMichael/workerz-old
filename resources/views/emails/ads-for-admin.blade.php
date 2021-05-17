@component('mail::message')
# Une annonce à été ajoutée {{$data["title"]}}

## Nom :

{{$data["title"]}}

<br/>

___

<br/>

## Métier :

{{$data["job"]}}

<br/>

___

<br/>

## Description :

{{$data["description"]}}


@component('mail::button',['url' => env('APP_URL').'/announcements/'.strtolower($data["title"])])
Voir l'annonce
@endcomponent

@endcomponent
