@component('mail::message')
# Une nouvelle annonce, restez l'esprit zen, quelqu'un vous contactera !

## Brève description de votre nouvelle annonce

### Nom de l'annonce :

{{$data["title"]}}

<br/>

___

<br/>

### Métier choisis :

{{$data["job"]}}

<br/>

___

<br/>

### Description :

{{$data["description"]}}


@component('mail::button',['url' => env('APP_URL').'/dashboard/ads'])
Voir mon annonce
@endcomponent

@endcomponent
