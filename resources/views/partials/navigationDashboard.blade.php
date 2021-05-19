<label for="menuDashboard" class="hidden">Ouverture du menu</label><input id="menuDashboard" type="checkbox"
                                                                          class="menuDashboard">
<nav>
    <li class="container-nav-principal">
        <ul class="full-height">
            <li class="container-list-menu full-height">
                <ul class="container-list-menu container-list-menu-principal container-menu-pincipal">
                    <li><a title="Page du dashboard"
                           class="iconeDashboard {{ Request::is('dashboard') ? "current_page_item_dashboard" : "" }}"
                           aria-current="{{ Request::is('dashboard') ? "page" : "" }}" href="{{ route('dashboard') }}">Tableau
                            de bord</a>
                    </li>
                    <li>
                        <a title="Page des notifications"
                           class="iconeDashboard {{ Request::is('dashboard/notifications') || Request::is('dashboard/notifications/*') ? "current_page_item_dashboard" : "" }}"
                           aria-current="{{ Request::is('dashboard/notifications') || Request::is('dashboard/notifications/*') ? "page" : "" }}"
                           href="{{route('dashboard.notifications')}}">Notifications</a>
                    </li>
                    <li>
                        <a title="Page des messages reçu"
                           class="iconeDashboard {{ Request::is('dashboard/messages') || Request::is('dashboard/messages/*') ? "current_page_item_dashboard" : "" }}"
                           aria-current="{{ Request::is('dashboard/messages') || Request::is('dashboard/messages/*') ? "page" : "" }}"
                           href="{{route('dashboard.messages')}}">Messages</a>
                    </li>
                    <li>
                        <a title="Page des annonces emises"
                           class="iconeDashboard {{ Request::is('dashboard/ads') || Request::is('dashboard/ads/*') ? "current_page_item_dashboard" : "" }}"
                           aria-current="{{ Request::is('dashboard/ads') || Request::is('dashboard/ads/*') ? "page" : "" }}"
                           href="{{route('dashboard.ads')}}">Annonces</a>
                    </li>
                    <li>
                        <a title="Page de profil"
                           class="iconeDashboard {{ Request::is('dashboard/profil') || Request::is('dashboard/profil/*') ? "current_page_item_dashboard" : "" }}"
                           aria-current="{{ Request::is('dashboard/profil') || Request::is('dashboard/profil/*') ? "page" : "" }}"
                           href="{{route('dashboard.profil')}}">Profil</a>
                    </li>
                    <li class="container-logout-dash">
                        <form aria-label="Déconnexion" role="form" id="logout-form"
                              action="{{route('logout')}}" method="POST"> @csrf
                            <button type="submit" role="button" title="Lien de déconnexion"
                                    class="iconeDashboard deconnexionButtonDashboard">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
                <ul class="container-list-menu-principal container-logout-dashboard">
                    <li>
                        <form aria-label="Déconnexion" role="form" id="logout-formm"
                              action="{{route('logout')}}" method="POST"> @csrf
                            <button type="submit" role="button" title="Lien de déconnexion"
                                    class="iconeDashboard deconnexionButtonDashboard">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</nav>
