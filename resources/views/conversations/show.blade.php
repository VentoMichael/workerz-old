@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('success-ads'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{{Session::get('success-ads')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if($errors->has('message'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}" alt="good icone">
            <p>{{$errors->first('message')}}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    <div class="container-all-dashboard">
        @include('partials.navigationDashboard')
        <section class="container-dashboard container-messages">
            <h2 aria-level="2">
                Mes messages
            </h2>
            <div class="container-form-ads">
                <livewire:messenger>
                </livewire:messenger>
                <div class="container-profil-dashboard container-ads-dashboard container-messenger-profil">
                    <div class="container-picture-title-dashboard-ads  container-messenger">
                    </div>
                    @if($messages->hasMorePages() || $messages->previousPageUrl())
                        <div class="link-next-previous">
                            @if($messages->hasMorePages())
                                <div class="@if($messages->previousPageUrl()) noMorePage @endif nextLink-container">
                                    <a class="nextLink" title="Voir les messages anciens"
                                       href="{{ $messages->nextPageUrl() }}">
                                        Voir les messages suivants
                                    </a>
                                </div>
                            @endif
                            @if($messages->previousPageUrl())
                                <div class="previousLink-container">
                                    <a class="previousLink" title="Voir les messages récents"
                                       href="{{ $messages->previousPageUrl() }}">
                                        Voir les messages précedents
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="container-messages-all">
                        @foreach($messages as $message)
                            <div @if($message->user->id == $user->id) class="container-from-msg container-message"
                                 @endif class="container-message">
                                <div class="container-picture-message">
                                    @if($message->user->picture)
                                        <img itemprop="image" src="{{ asset($message->user->picture) }}"
                                             alt="photo de profil de {{ucfirst($message->user->name)}}"/>
                                    @else
                                        <img itemprop="image" src="{{asset('svg/user.svg')}}"
                                             alt="icone d'annonces">
                                    @endif
                                </div>
                                <div>
                                    <p class="date-message"> @if($message->user->id == $user->id)
                                            Moi  @else {{$message->user->name}} @endif {{$message->created_at->locale('fr')->isoFormat('Do MMMM, H:mm')}}</p>
                                    <p class="content-message">{{$message->content}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <form class="form-login" style="position: relative" enctype="multipart/form-data"
                          aria-label="Enregistrement d'un compte" role="form" method="POST"
                          action="/dashboard/messages/{{$user->slug}}">
                        @csrf

                        <label for="message" class="hidden">Entrer votre message</label>
                        <textarea type="text" class="input-message @if($errors->has('message')) is-invalid @endif"
                                  placeholder="Votre message ..." name="message"
                                  id="message"></textarea>

                        <input type="hidden" name="from_id" id="from_id" value="{{$user->id}}">
                        <input type="hidden" name="to_id" id="to_id" value="{{auth()->user()->id}}">
                        <button type="submit" class="submit-message" title="Envoyer le message"></button>
                        @error('message')
                        <p class="danger help"
                           style="position: absolute;top: -30px;background: white;border-radius: 5px;padding: 0 3% 5px;margin-bottom: -3%;">
                            {{$errors->first('message')}}
                        </p>
                        @enderror
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    @livewireScripts
@endsection
