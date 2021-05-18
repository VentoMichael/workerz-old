@component('mail::message')
# Nous accusons bonne réception de votre message via notre formulaire de contact

## En voici la copie :

### Sujet :
{{$data["subject"]}}

<br />

___

<br />

### Message :

{{$data["message"]}}

@component('mail::button',['url' => env('APP_URL').'/workerz'])
Les nouveaux indépendents
@endcomponent

@endcomponent
