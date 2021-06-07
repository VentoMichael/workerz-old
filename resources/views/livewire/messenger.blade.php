<div
    class="@if($users->count() < 1) no-Users @endif container-search-ads @if(Request::is('dashboard/messages')) container-messenger-form @endif">
    @if($users->count() > 0)
        <form action="{{$firstUser->slug.request('search')}}" aria-label="Rechercher mes messages" role="search"
              method="get" class="formSearchAd submit-msg">
            <label for="search" class="hidden">Rechercher mes messages</label>
            <input type="text" name="search" value="{{request('search')}}" id="search"
                   wire:model="search"
                   placeholder="Rechercher par nom"
                   class="search-announcement search-home search-ads">
            <input type="hidden" name="firstAd" value="{{$firstUser->slug}}">
            <noscript>
                <button type="submit" class="button-cta submit-category-home submit-ad submit-msg">Recherchez</button>
            </noscript>
        </form>
    @endif
    <div class="container-announcments-dashboard @if($users->count() < 1)container-search-without-ads @endif"
         wire:loading.class="load">
        @forelse($users as $user)
            <div class="container-message-index">
                <a class="{{ Request::is('dashboard/messages/'.$user->slug) || Request::is('dashboard/messages/'.$user->slug.'/*') ? "container-announcements-active" : "" }} container-announcements"
                   href="{{route('dashboard.messagesShow',[$user->slug])}}"
                   aria-current="{{ Request::is('dashboard/messages/*') ? "page" : "" }}">
                    <section>
                        <img width="50" height="50" src="{{asset('svg/messenger.svg')}}" alt="icone de messages">
                    @if(count($user->relatedTo->where('is_read',0)) > 0 && count($user->relatedTo->where('is_read',0)) > 9)
                            <span class="counter-read-message">
                                    9+
                                </span>
                        @else
                            @if(count($user->relatedTo->where('is_read',0)) !== 0)
                                <span class="counter-read-message">
                                    {{count($user->relatedTo->where('is_read',0)->where('to_id','!=',ucfirst($user->name)))}}
                                </span>
                            @endif
                        @endif
                        <div>
                            <h3 aria-level="3">
                                {{ucfirst($user->name)}} {{ucfirst($user->surname)}}
                            </h3>
                            @if($user->role_id === 2)
                                <p>
                                    {{$user->job}}
                                </p>
                            @else
                                <p>
                                    {{$user->job}}
                                </p>
                            @endif
                        </div>
                    </section>
                </a>
                <form action="{{route('delete.conversations',$user->slug)}}" class="form-delete-msg" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="button-delete-msg" title="Supprimer la conversation avec {{$user->name}}">
                        supprimer
                    </button>
                </form>
            </div>
        @empty
            <div class="container-announcements container-msg-notFound" style="margin: 0;padding: 5% 3%;">
                <section>
                    <img width="50" height="50" src="{{asset('svg/market.svg')}}" alt="icone d'annonce">

                    <div>
                        <h3 aria-level="3">
                            Aucune conversation trouvée ...
                        </h3>
                        <a class="button-cta" href="{{route('workerz')}}">
                            <span>Toutes les entreprises</span>
                        </a>
                    </div>
                </section>
            </div>
        @endforelse
    </div>
</div>
@if($users->count())
@section('scripts')
    <script src="{{asset('js/confirmDelete-msg.js')}}"></script>
    @livewireScripts
    <script>let btnMsg=document.getElementById("btnMsgSend"),helpMsg=document.getElementById("helpMsg");btnMsg&&(document.getElementById("message").addEventListener("keyup",e=>{btnMsg.classList.add("styleBtnMsg"),helpMsg.classList.add("helpMsg"),""===document.getElementById("message").value&&(btnMsg.classList.remove("styleBtnMsg"),helpMsg.classList.remove("helpMsg"))}),document.getElementById("container-message").addEventListener("click",()=>{document.getElementById("message").focus()}),document.addEventListener("keydown",e=>{event.ctrlKey&&"Enter"===event.key&&document.getElementById("formMsg").submit()}));</script>
@endsection
@endif
