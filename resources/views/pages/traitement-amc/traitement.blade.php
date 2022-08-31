@extends('layouts.app', ['page_name' => "Chaine de validation des demandes",
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Traitement des A.M.C.'])

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class="widget-content widget-content-area animated-underline-content">

                    <h4>Traitement de la demande d'AMC <strong>N° {{ $amc->getNumDemande() }}</strong> </h4>

                    <ul class="nav nav-tabs mt-3" id="border-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#border-home" role="tab" aria-selected="true">
                                <i data-feather="users"></i>
                                <span>Traitement à effectuer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#border-voyage" role="tab" aria-selected="false">
                                <i data-feather="map"></i>
                                <span>Infos Voyage</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#border-produit" role="tab" aria-selected="false">
                                <i data-feather="shopping-bag"></i>
                                <span>Infos Produits</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#border-pj" role="tab" aria-selected="false">
                                <i data-feather="paperclip"></i>
                                <span>Pièces Jutificatives</span>
                            </a>
                        </li>
                        @if($amc->estDepote())
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#border-ra" role="tab" aria-selected="false">
                                    <i data-feather="edit"></i>
                                    <span>Rapport d'inspection</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content mb-4" id="border-tabsContent">
                        <div class="tab-pane fade show active" id="border-home" role="tabpanel">

                            <form method="post" id="form-traitement" action="{{ route('traitement-amc.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$amc->slug}}" name="slug">
                                <input type="hidden" value="{{$amc->etat}}" name="old_etat" id="old_etat">
                                @if($amc->etat == 1)
                                    <hr> <h4>Quelle action voulez-vous entreprendre ?</h4>
                                    <table class="table">
                                        <tr class="row">
                                            <td class="col-6">
                                                <input checked type="radio" id="affecter_demande" value="affecter_demande" name="traitement_demande" class="custom-control-input">
                                                <label class="custom-control-label" for="affecter_demande">Affecter la demande à des agents pour étude</label>
                                            </td>
                                            <td class="col-6">
                                                <input type="radio" id="traiter_demande" value="traiter_demande" name="traitement_demande" class="custom-control-input">
                                                <label class="custom-control-label" for="traiter_demande">Etudier la demande directement</label>
                                            </td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-6">
                                                <span class="affecter_demande">
                                                    <select class="form-control basic" multiple="multiple" name="affecter_demande[]">
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td>
                                            <td class="col-6 row">
                                                <div class="col-12 input-group-sm traiter_demande" style="display: none">
                                                    <select  class="form-control basic" multiple="multiple" name="traiter_demande[]">
                                                        @foreach($precriptions as $precription)
                                                            <option value="{{ $precription->id }}">{{ $precription->libelle }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!--div class="col-12 input-group-sm traiter_demande" style="display: none">
                                                    <label for="comments_traitement">Commentaire sur le traitement</label>
                                                    <textarea class="form-control" name="comments_traitement" id="comments_traitement"></textarea>
                                                </div-->
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <div class="form-row mb-2">
                                        @if($amc->etat == 2)
                                            <div class="col-5 row">
                                                <div class="col-12 input-group-sm etude">
                                                    <label for="prescriptions">Avis après étude de la demande</label>
                                                    <select required class="form-control basic" multiple="multiple" name="prescriptions[]">
                                                        @foreach($precriptions as $precription)
                                                            <option value="{{ $precription->id }}">{{ $precription->libelle }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!--div class="col-12 input-group-sm etude">
                                                    <label for="comments_avis">Commentaire sur l'avis</label>
                                                    <textarea class="form-control" name="comments_avis" id="comments_avis"></textarea>
                                                </div-->
                                            </div>
                                            <div class="col-1"></div>
                                            <div class="col-6 input-group-sm row">
                                                <div class="col-12 input-group-sm">
                                                    <label for="traiter_demande">Traitement à effectuer</label>
                                                    <input type="hidden" value="traiter_demande" name="traitement_demande">
                                                    <select class="form-control" name="traiter_demande" id="traiter_demande">
                                                        @foreach($tab_suivant as $suivant)
                                                            <option value="{{ $suivant->id }}">{{ $suivant->libelle_dgcc }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12 input-group-sm comments_traitement" style="display: none"><br>
                                                    <label for="comments_traitement">Commentaire sur le traitement</label>
                                                    <textarea class="form-control" name="comments_traitement" id="comments_traitement"></textarea>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-6 input-group-sm">
                                                <label for="traiter_demande">Traitement à effectuer</label>
                                                <input type="hidden" value="traiter_demande" name="traitement_demande">
                                                    @if($amc->etat == '6')
                                                        <br><span>En attente de <b>paiement de l'ordre de recette</b> par l'usager</span>
                                                    @elseif($amc->etat == '10')
                                                        <br>
                                                        <span>Chaine de traitement du dossier terminée</span><br><br>
                                                        <div class="row">
                                                            <a class="col-4" target="_blank" href="{{ route('traitement-amc.dwlamc', $amc->slug) }}">
                                                                Voir l'AMC
                                                            </a>
                                                            <a class="col-4" target="_blank" href="{{ route('traitement-amc.dwlanx', $amc->slug) }}">
                                                                Voir les annexes
                                                            </a>
                                                            <span class="col-4">
                                                                @if($amc->getEtatRapport() == 0)
                                                                    <strong class="alert-danger">Inspection non conforme</strong>
                                                                    <a target="_blank" href="{{ route('traitement-amc.dwlrpt', $amc->slug) }}">
                                                                        (Voir rapport d'inspection)
                                                                    </a>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @elseif($amc->etat == '4' && $amc->totalglobal != 0)
                                                        <select class="form-control" name="traiter_demande" id="traiter_demande">
                                                            @foreach($tab_suivant as $suivant)
                                                                @if($suivant->id != '9')
                                                                    <option value="{{ $suivant->id }}">{{ $suivant->libelle_dgcc }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @elseif($amc->etat == '4' && $amc->totalglobal == 0)
                                                        <select class="form-control" name="traiter_demande" id="traiter_demande">
                                                            @foreach($tab_suivant as $suivant)
                                                                @if($suivant->id != '5')
                                                                    <option value="{{ $suivant->id }}">{{ $suivant->libelle_dgcc }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        <select class="form-control" name="traiter_demande" id="traiter_demande">
                                                            @foreach($tab_suivant as $suivant)
                                                                <option value="{{ $suivant->id }}">{{ $suivant->libelle_dgcc }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                            </div>
                                            <div class="col-6"></div>
                                            <div class="col-6 comments_traitement" style="display: none"><br>
                                                <label for="comments_traitement">Commentaire sur le traitement</label>
                                                <textarea class="form-control" name="comments_traitement" id="comments_traitement"></textarea>
                                            </div>
                                        @endif
                                        {{--
                                        @if($amm->etat == 4)
                                            <div class="col-6 row">
                                                <div class="col-12 input-group-sm">
                                                    <label for="totalpen">Pénalités appliquées</label>
                                                    <input class="form-control" type="number" id="totalpen" name="totalpen" value="0" min="0" />
                                                </div>
                                                <div class="col-12 input-group-sm">
                                                    <label for="fiche_crtl">Joindre la fiche de contrôle rensignée</label>
                                                    <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="fiche_crtl" name="fiche_crtl" />
                                                </div>
                                            </div>
                                        @endif
                                        --}}

                                        @if($amc->etat == 8)
                                            <div class="col-9">
                                                <br>
                                                <div class="row">
                                                    <a class="col-4" target="_blank" href="{{ route('traitement-amc.dwlamc', $amc->slug) }}">
                                                        Télécharger l'AMC
                                                    </a>
                                                    <a class="col-4" target="_blank" href="{{ route('traitement-amc.dwlanx', $amc->slug) }}">
                                                        Télécharger les annexes
                                                    </a>
                                                </div>

                                            </div>
                                        @endif

                                        @if($amc->etat == 7)
                                            <div class="col-9">
                                                <br>
                                                <div class="col-12 input-group-sm row">
                                                    <label for="quittance">
                                                        Numéro de la quittance : <b>{{ $odr->quittance }}</b>
                                                    </label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <label for="datequittance">
                                                        Date de paiement : <b>{{ date_format(new DateTime($odr->datequittance), 'd/m/Y') }}</b>
                                                    </label>

                                                    <a style="margin-left: 5%" href="{{ url('/uploads/'.$amc->getContribuable->nif.'/amm_'.$amc->id.'/pj_quittance.pdf')}}" target="_blank">
                                                        Voir la quittance
                                                    </a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                    <hr>
                                @endif

                                @if(!in_array($amc->etat, array(6, 10, 998)))
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                @endif
                            </form>
                        </div>
                        <div class="tab-pane fade" id="border-voyage" role="tabpanel">

                            <div class="form-row mb-2">
                                <div class="col-6 input-group-sm">
                                    <label for="paysprov">Pays de provenance</label>
                                    <input type="text" readonly value="{{$amc->paysprov}}" name="paysprov" id="paysprov" class="form-control" />
                                </div>
                                <div class="col-6 input-group-sm">
                                    <label for="modetransport">Mode de transport</label>
                                    <input type="text" readonly value="{{$amc->modetransport}}" name="modetransport" id="modetransport" class="form-control" />
                                </div>
                            </div>
                            @if($amc->modetransport == "Aérien")
                                @foreach($amc->getVols as $amc_vol)
                                    <div class="form-row mb-2 aerienne">
                                        <div class="col-4 input-group-sm">
                                            <label for="numlta">N° LTA</label>
                                            <input readonly value="{{$amc_vol->numlta}}" type="text" name="numlta" id="numlta" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="cieaerien">Compagnie aérienne</label>
                                            <input readonly value="{{$amc_vol->cieaerien}}" type="text" name="cieaerien" id="cieaerien" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="numvol">N° vol</label>
                                            <input readonly value="{{$amc_vol->numvol}}" type="text" name="numvol" id="numvol" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($amc->modetransport == "Maritime")
                                @foreach($amc->getConteneurs as $amc_cont)
                                    <div class="form-row mb-2 maritime">
                                        <div class="col-2 input-group-sm">
                                            <label for="nomnavire">Nom du navire</label>
                                            <input readonly value="{{$amc_cont->nomnavire}}" type="text" required name="nomnavire" id="nomnavire" class="form-control" />
                                        </div>
                                        <div class="col-2 input-group-sm">
                                            <label for="numvoyagem">N° voyage</label>
                                            <input readonly value="{{$amc_cont->numvoyage}}" type="text" name="numvoyagem" id="numvoyagem" class="form-control" />
                                        </div>
                                        <div class="col-2 input-group-sm">
                                            <label for="numbietc">N° BIETC</label>
                                            <input readonly value="{{$amc_cont->numbietc}}" type="text" name="numbietc" id="numbietc" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="numconnaissement">N° connaissement</label>
                                            <input readonly value="{{$amc_cont->numconnaissement}}" type="text" required name="numconnaissement" id="numconnaissement" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="numconteneurm">N° conteneur</label>
                                            <input readonly value="{{$amc_cont->numconteneur}}" type="text" required name="numconteneurm" id="numconteneurm" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($amc->modetransport == "Terrestre")
                                @foreach($amc->getVehicules as $amc_veh)
                                    <div class="form-row mb-2 terrestre">
                                        <div class="col-4 input-group-sm">
                                            <label for="numlvi">N° LVI</label>
                                            <input readonly value="{{$amc_veh->numlvi}}" type="text" name="numlvi" id="numlvi" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="numvehicule">N° véhicule</label>
                                            <input readonly value="{{$amc_veh->numvehicule}}" type="text" name="numvehicule" id="numvehicule" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="numconteneurt">N° conteneur (si disponible)</label>
                                            <input readonly value="{{$amc_veh->numconteneur}}" type="text" name="numconteneurt" id="numconteneurt" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($amc->modetransport == "Ferroviaire")
                                <div class="form-row mb-2 ferroviaire">
                                    <div class="col-6 input-group-sm">
                                        <label for="numwagon">N° Wagon</label>
                                        <input readonly value="{{$amc->numwagon}}" type="text" name="numwagon" id="numwagon" class="form-control" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="numvoyagef">N° voyage</label>
                                        <input readonly value="{{$amc->numvoyagef}}" type="text" name="numvoyagef" id="numvoyagef" class="form-control" />
                                    </div>
                                </div>
                            @endif
                            <div class="form-row mb-2">
                                <div class="col-6 input-group-sm">
                                    <label for="dateembarque">Date d'embarquement</label>
                                    <input type="date" readonly value="{{$amc->dateembarque}}" name="dateembarque" id="dateembarque" class="form-control" />
                                </div>
                                <div class="col-6 input-group-sm">
                                    <label for="lieuembarque">Lieu d'embarquement</label>
                                    <input type="text" readonly value="{{$amc->lieuembarque}}" name="lieuembarque" id="lieuembarque" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <div class="col-6 input-group-sm">
                                    <label for="datedebarque">Date de débarquement</label>
                                    <input type="date" readonly value="{{$amc->datedebarque}}" name="datedebarque" id="datedebarque" class="form-control" />
                                </div>
                                <div class="col-6 input-group-sm">
                                    <label for="lieudebarque">Lieu de débarquement</label>
                                    <input type="text" readonly value="{{$amc->lieudebarque}}" name="lieudebarque" id="lieudebarque" class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="border-produit" role="tabpanel">

                            @foreach($amc->getProduitAmcs as $amcs_produit)
                                <h6><u>Informations de produits {{ 1 + $loop->index }}</u></h6>
                                <div class="form-row mb-4">
                                    <div class="col-2 input-group-sm">
                                        <label for="numfact">N° facture</label>
                                        <input type="text" readonly value="{{$amcs_produit->numfact}}" name="numfact" id="numfact" class="form-control" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="datefact">Date de facture</label>
                                        <input type="date" readonly value="{{$amcs_produit->datefact}}" name="datefact" id="datefact" class="form-control" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="fournisseur">Nom du fournisseur</label>
                                        <input type="text" readonly value="{{$amcs_produit->fournisseur}}" name="fournisseur" id="fournisseur" class="form-control" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="paysorig">Pays d'origine</label>
                                        <input type="text" readonly value="{{$amcs_produit->paysorig}}" name="paysorig" id="pays_or" class="form-control" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="idproduit">Produit</label>
                                        <input type="text" readonly value="{{$amcs_produit->getProduit->libelle}}" name="marque" id="marque" class="form-control" />
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <label for="marque">Marque</label>
                                        <input type="text" readonly value="{{$amcs_produit->marque}}" name="marque" id="marque" class="form-control" />
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <label for="poids">Poids (Kg)</label>
                                        <input type="text" readonly value="{{ number_format($amcs_produit->poids, 0, ',', ' ') }}" name="poids" min="0" id="poids" class="form-control" onblur="getProduit(this.name, this.value)" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="total">Montant</label>
                                        <input type="text" readonly value="{{ number_format($amcs_produit->total, 0, ',', ' ') }}" name="total" id="total" class="form-control" />
                                    </div>
                                </div>
                                <hr >
                            @endforeach
                            <div class="form-row mb-2">
                                <div class="col-3 input-group-sm">
                                    <label for="valeurcaf_ext">Valeur CAF totale (Devise)</label>
                                    <input type="text" readonly value="{{ number_format($amc->valeurcaf_ext, 0, ',', ' ') }}" name="valeurcaf_ext" min="0" id="valeurcaf_ext" class="form-control calculproduit" />
                                </div>
                                <div class="col-2 input-group-sm">
                                    <label for="valeurcaf_dev">Devise</label>
                                    <input type="text" readonly value="{{ $amc->valeurcaf_dev }}" name="valeurcaf_dev" min="0" id="valeurcaf_ext" class="form-control calculproduit" />
                                </div>
                                <div class="col-3"></div>
                                <div class="col-4 input-group-sm">
                                    <label for="valeurcaf_cfa">Valeur CAF totale (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amc->valeurcaf_cfa, 0, ',', ' ') }}" name="valeurcaf_dev" min="0" id="valeurcaf_ext" class="form-control calculproduit" />
                                </div>
                            </div>
                            <hr />
                            <div class="form-row mb-2">
                                <div class="col-3 input-group-sm"></div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalpoids">Poids total (Kg)</label>
                                    <input type="text" readonly value="{{ number_format($amc->totalpoids, 0, ',', ' ') }}" name="totalpoids" id="totalpoids" class="form-control" />
                                </div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalfrais">Montany total (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amc->totalfrais, 0, ',', ' ') }}" name="totalfrais" id="totalfrais" class="form-control" />
                                </div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalenr">Frais d'enregistrement (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amc->totalenr, 0, ',', ' ') }}" name="totalenr" id="totalenr" class="form-control" />
                                </div>
                            </div>
                            <hr />
                            <div class="form-row mb-2">
                                <div class="col-9 input-group-sm"></div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalglobal">Frais total à payer (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amc->totalglobal, 0, ',', ' ') }}" name="totalglobal" id="totalglobal" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="border-pj" role="tabpanel">
                            @foreach($amc->getDocumentAmcs as $amcs_doc)
                                <div class="form-row mb-2">
                                    <div class="col-10 input-group-sm">
                                        {{  $amcs_doc->libelle }}
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <a href="{{ url('/uploads/'.$amc->getContribuable->nif.'/amm_'.$amc->id.'/'.$amcs_doc->pj)}}" target="_blank"> <i data-feather="link"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="border-ra" role="tabpanel">
                            <div class="row">
                                @if($amc->haveRapport())
                                    <div class="col-7">
                                        <span>Rapport d'inspection disponible</span><br><br>
                                        <div class="row">
                                            <a class="col-6" target="_blank" href="{{ route('traitement-amc.dwlrpt', $amc->slug) }}">
                                                Voir le rapport d'inspection
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-8">
                                        Aucun rapport disponible
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('traitement-amc.rapport', $amc->slug) }}" class="btn btn-success">Démarrer le rapport d'inspection</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
