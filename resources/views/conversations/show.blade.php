@extends('layouts.appDashboard')
@section('content')
    @if (Session::has('success-ads'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/good.svg')}}" alt="good icone">
            <p>{!!session('success-ads')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if($errors->has('message'))
        <div id="successMsg" role="alert" class="successMsg"><img width="40" height="60" src="{{asset('svg/cross.svg')}}" alt="good icone">
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
            <div class="container-form-ads container-form-msgs">
                <livewire:messenger>
                </livewire:messenger>
                <div class="container-profil-dashboard container-ads-dashboard container-messenger-profil">
                    <div class="container-picture-title-dashboard-ads  container-messenger">
                    </div>
                    @if($messages->count() > 20)
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
                    @endif
                    <section class="container-messages-all" id="container-message">
                        <div class="container-helper-message">
                            <h4 aria-level="4">
                                <span class="hidden"> Utilisateur sélectionné </span>{{$user->name}} {{$user->surname}}
                            </h4>
                        </div>
                        @foreach($messages as $message)
                            @if($message->content != null)
                                <div @if($message->user->id == $user->id) class="container-from-msg container-message"
                                     @endif class="container-message">
                                    <div class="container-picture-message">
                                        @if($message->user->picture)
                                            <img width="40" height="60" itemprop="image" src="{{ asset($message->user->picture) }}"
                                                 alt="photo de profil de {{ucfirst($message->user->name)}}"/>
                                        @else
                                            <img width="40" height="60" itemprop="image" src="{{asset('svg/user.svg')}}"
                                                 alt="icone d'annonces">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="date-message"> @if($message->receiver->id == $user->id)
                                                Moi,  @else {{$message->user->name}}, @endif {{$message->created_at->locale('fr')->isoFormat('Do MMMM, H:mm')}}</p>
                                        <p class="content-message">{{$message->content}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </section>
                    <form id="formMsg" class="form-login" style="position: relative" enctype="multipart/form-data"
                          aria-label="Envoie d'un message à {{$user->name}}" role="form" method="POST"
                          action="{{route('messages.post',[$user->slug])}}">
                        @csrf

                        <label for="message" class="hidden">Entrer votre message</label>
                        <textarea type="text" class="input-message @if($errors->has('message')) is-invalid @endif"
                                  placeholder="Votre message ..." name="message"
                                  id="message"></textarea>

                        <input type="hidden" name="from_id" id="from_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="to_id" id="to_id" value="{{$user->id}}">
                        <button type="submit" id="btnMsgSend" class="submit-message" title="Envoyer le message à {{$user->name}}"><span class="helpSendMsg" id="helpMsg">Ctrl + Enter</span></button>

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
