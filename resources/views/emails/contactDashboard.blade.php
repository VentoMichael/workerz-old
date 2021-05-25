@component('mail::message')
# Un nouveau mail dans votre boîte à messages !
{{$message->user->name}} vous a envoyer un message
<br />

___

Le message contient:
{{$message->content}}

@component('mail::button',['url' => env('APP_URL').'/dashboard/messages'])
Je vais voir
@endcomponent

@endcomponent
