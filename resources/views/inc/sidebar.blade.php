@if ($page_name != 'coming_soon' && $page_name != 'contact_us' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">

                @if (Auth::user()->profilid == 2)

                    <li class="menu {{ ($category_name === 'Accueil') ? 'active' : '' }}">
                        <a href="{{ url('accueil')  }}" data-active="{{ ($category_name === 'Accueil') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'Accueil') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="home"></i><span>Accueil</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ ($category_name === 'Demandes A.M.M.') ? 'active' : '' }}">
                        <a href="#amm" data-active="{{ ($category_name === 'Demandes A.M.M.') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Demandes A.M.M.') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="clipboard"></i><span>Demandes A.M.M.</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Demandes A.M.M.') ? 'show' : '' }}" id="amm" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'Nouvelle demande') ? 'active' : '' }}">
                                <a href="{{ route('amm.create')  }}"> Nouvelle demande </a>
                            </li>
                            <li class="{{ ($page_name === 'Mes demandes') ? 'active' : '' }}">
                                <a href="{{ route('amm.index')  }}"> Mes demandes </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Demandes A.M.C.') ? 'active' : '' }}">
                        <a href="#amc" data-active="{{ ($category_name === 'Demandes A.M.C.') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Demandes A.M.C.') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="file"></i><span>Demandes A.M.C.</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Demandes A.M.C.') ? 'show' : '' }}" id="amc" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'Nouvelle demande') ? 'active' : '' }}">
                                <a href="{{ route('amc.create')  }}"> Nouvelle demande </a>
                            </li>
                            <li class="{{ ($page_name === 'Mes demandes') ? 'active' : '' }}">
                                <a href="{{ route('amc.index')  }}"> Mes demandes </a>
                            </li>
                        </ul>
                    </li>
                @endif



                @if (Auth::user()->profilid != 2)

                    <li class="menu {{ ($page_name === 'Tableau de bord') ? 'active' : '' }}">
                        <a href="{{ url('dashboard')  }}" data-active="{{ ($category_name === 'Accueil') ? 'true' : 'false' }}" aria-expanded="{{ ($category_name === 'Accueil') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Tableau de bord</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ ($category_name === 'Gestion des A.M.M.') ? 'active' : '' }}">
                        <a href="#amm" data-active="{{ ($category_name === 'Gestion des A.M.M.') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Gestion des A.M.M.') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="file"></i><span>Gestion des A.M.M.</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Traitement des A.M.M.') ? 'show' : '' }}" id="amm" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'Nouvelle AMM') ? 'active' : '' }}">
                                <a href="#"> Nouvelle demande </a>
                            </li>
                            <li class="{{ ($page_name === 'Etude des demandes') ? 'active' : '' }}">
                                <a href="{{ route('traitement-amm.etude')  }}"> Etude demandes </a>
                            </li>
                            <li class="{{ ($page_name === 'Validation des demandes') ? 'active' : '' }}">
                                <a href="{{ route('traitement-amm.valide')  }}"> Validation demandes </a>
                            </li>
                            <li class="{{ ($page_name === 'Demandes traitées') ? 'active' : '' }}">
                                <a href="{{ route('traitement-amm.traite')  }}"> Demandes traitées </a>
                            </li>
                            <li class="{{ ($page_name === 'Etat de toutes les demandes') ? 'active' : '' }}">
                                <a href="{{ route('traitement-amm.state')  }}"> Toutes les demandes </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Gestion des A.M.C.') ? 'active' : '' }}">
                        <a href="#amc" data-active="{{ ($category_name === 'Gestion des A.M.C.') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Gestion des A.M.C.') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="clipboard"></i><span>Gestion des A.M.C.</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Gestion des A.M.C.') ? 'show' : '' }}" id="amc" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'basic') ? 'active' : '' }}">
                                <a href="#"> Nouvelle demande </a>
                            </li>
                            <li class="{{ ($page_name === 'input_group') ? 'active' : '' }}">
                                <a href="#"> Demandes en attente </a>
                            </li>
                            <li class="{{ ($page_name === 'layouts') ? 'active' : '' }}">
                                <a href="#"> Validation demandes </a>
                            </li>
                            <li class="{{ ($page_name === 'validation') ? 'active' : '' }}">
                                <a href="#"> Demandes traitées </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Gestion des contribuables') ? 'active' : '' }}">
                        <a href="#contribuables" data-active="{{ ($category_name === 'Gestion des contribuables') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Gestion des contribuables') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="icon-container">
                                <i data-feather="shopping-bag"></i><span>Base Contribuables</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Gestion des contribuables') ? 'show' : '' }}" id="contribuables" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'Nouveau contribuable') ? 'active' : '' }}">
                                <a href="{{ route('contribuables.create')  }}"> Nouveau contribuable </a>
                            </li>
                            <li class="{{ ($page_name === 'Liste des contribuables') ? 'active' : '' }}">
                                <a href="{{ route('contribuables.index')  }}"> Liste contribuables</a>
                            </li>
                            <li class="{{ ($page_name === "Comptes en attente d'activation") ? 'active' : '' }}">
                                <a href="{{ url('demande-comptes/list')  }}"> En attente de validation</a>
                            </li>
                            <li class="{{ ($page_name === 'Type de contribuables') ? 'active' : '' }}">
                                <a href="{{ route('type-contribuables.index')  }}"> Types contribuables</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Gestion des Produits') ? 'active' : '' }}">
                        <a href="#produits" data-active="{{ ($category_name === 'Gestion des Produits') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Gestion des Produits') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="icon-container">
                                <i data-feather="grid"></i><span>Base Produits</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Gestion des Produits') ? 'show' : '' }}" id="produits" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'Catégorie des Produits') ? 'active' : '' }}">
                                <a href="{{ route('categorie-produits.index')  }}"> Catégorie de produits </a>
                            </li>
                            <li class="{{ ($page_name === 'Liste des Produits') ? 'active' : '' }}">
                                <a href="{{ route('produits.index')  }}"> Liste de produits</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Administration') ? 'active' : '' }}">
                        <a href="#admin" data-active="{{ ($category_name === 'Administration') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Administration') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <div class="icon-container">
                                    <i data-feather="list"></i><span>Administration</span>
                                </div>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Administration') ? 'show' : '' }}" id="admin" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'Utilisateurs') ? 'active' : '' }}">
                                <a href="{{ route('users.index')  }}"> Utilisateurs </a>
                            </li>
                            <li class="{{ ($page_name === 'Profils') ? 'active' : '' }}">
                                <a href="{{ route('profils.index')  }}"> Profils </a>
                            </li>
                            <li class="{{ ($page_name === 'Habilitations') ? 'active' : '' }}">
                                <a href="#"> Habilitations </a>
                            </li>
                            <li class="{{ ($page_name === 'Mouchard') ? 'active' : '' }}">
                                <a href="#"> Mouchard </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ ($category_name === 'Parametrage') ? 'active' : '' }}">
                        <a href="#param" data-active="{{ ($category_name === 'Parametrage') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'Parametrage') ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="icon-container">
                                <i data-feather="settings"></i><span>Parametrage</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ ($category_name === 'Parametrage') ? 'show' : '' }}" id="param" data-parent="#accordionExample">
                            <li class="{{ ($page_name === 'Grille des Prescription') ? 'active' : '' }}">
                                <a href="#"> Grille des Prescriptions </a>
                            </li>
                        </ul>
                    </li>

                @endif

            </ul>

        </nav>

    </div>
    <!--  END SIDEBAR  -->

@endif
