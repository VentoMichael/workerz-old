<label for="menuDashboard" class="hidden">Ouverture du menu</label><input id="menuDashboard" type="checkbox"
                                                                          class="menuDashboard">
<nav>
    <li class="container-nav-principal">
        <ul class="full-height">
            <li class="container-list-menu full-height">
                <ul class="container-list-menu container-list-menu-principal container-menu-pincipal">
                    <li><a title="Page du tableau de bord"
                           class="iconeDashboard icone-home-dashboard {{ Request::is('dashboard') ? "current_page_item_dashboard" : "" }}" {{ Request::is('dashboard')? "aria-current='page'" : "" }} href="{{ route('dashboard') }}">Tableau
                            de bord</a>
                    </li>
                    <li>
                        <a title="Page des notifications"
                           class="iconeDashboard icone-notifications-dashboard {{ Request::is('dashboard/notifications') || Request::is('dashboard/notifications/*') ? "current_page_item_dashboard" : "" }}" {{ Request::is('dashboard/notifications') || Request::is('dashboard/notifications/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.notifications')}}">Notifications</a>
                    </li>
                    <li>
                        <a title="Page des messages reçu"
                           class="iconeDashboard icone-messages-dashboard {{ Request::is('dashboard/messages') || Request::is('dashboard/messages/*') ? "current_page_item_dashboard" : "" }}"
                           {{ Request::is('dashboard/messages') || Request::is('dashboard/messages/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.messages')}}">Messages</a>
                    </li>
                    <li>
                        <a title="Page des annonces emises"
                           class="iconeDashboard icone-ads-dashboard {{ Request::is('dashboard/ads') || Request::is('dashboard/ads/*') ? "current_page_item_dashboard" : "" }}" {{ Request::is('dashboard/ads') || Request::is('dashboard/ads/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.ads')}}">Annonces</a>
                    </li>
                    <li>
                        <a title="Page de profil"
                           class="iconeDashboard icone-profil-dashboard {{ Request::is('dashboard/profil') || Request::is('dashboard/profil/*') ? "current_page_item_dashboard" : "" }}" {{ Request::is('dashboard/profil') || Request::is('dashboard/profil/*') ? "aria-current='page'" : "" }} href="{{route('dashboard.profil')}}">Profil</a>
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
