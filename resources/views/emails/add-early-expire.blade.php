@component('mail::message')
# Attention, il ne reste plus qu'un jour à votre annonce {{$data["title"]}}

@component('mail::button',['url' => env('APP_URL').'/dashboard/ads'])
Je viens l'upgrader
@endcomponent

@endcomponent
