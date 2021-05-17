@component('mail::message')
# Nouveau abonné a la newsletter !

@component('mail::button',['url' => env('APP_URL').'/nova'])
Accéder au dashboard
@endcomponent

@endcomponent
