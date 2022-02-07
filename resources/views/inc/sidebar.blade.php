@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">

                @if ($page_name != 'alt_menu' && $page_name != 'blank_page' && $page_name != 'boxed' && $page_name != 'breadcrumb' )

                    <li class="menu {{ ($category_name === 'bootstrap_basic_table') ? 'active' : '' }}">
                        <a href="/tables/bootstrap_basic" data-active="{{ ($category_name === 'bootstrap_basic_table') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'bootstrap_basic_table') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Accueil</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu {{ ($category_name === 'users') ? 'active' : '' }}">
                        <a href="#users" data-active="{{ ($category_name === 'users') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'users') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                <span>Mise en Consommation</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'users') ? 'show' : '' }}" id="users" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'profile') ? 'active' : '' }}">
                                <a href="/users/profile"> Nouvelle demande </a>
                            </li>
                            <li class="{{ ($page_name === 'account_setting') ? 'active' : '' }}">
                                <a href="/users/account_settings"> Mes demandes </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu {{ ($category_name === 'users') ? 'active' : '' }}">
                        <a href="#users" data-active="{{ ($category_name === 'users') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'users') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                <span>Mise sur le Marché</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'users') ? 'show' : '' }}" id="users" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'profile') ? 'active' : '' }}">
                                <a href="/users/profile"> Nouvelle demande </a>
                            </li>
                            <li class="{{ ($page_name === 'account_setting') ? 'active' : '' }}">
                                <a href="/users/account_settings"> Mes demandes </a>
                            </li>
                        </ul>


                @endif

            </ul>

        </nav>

    </div>
    <!--  END SIDEBAR  -->

@endif
