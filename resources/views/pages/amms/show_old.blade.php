@extends('layouts.app', ['page_name' => 'Mes demandes',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.M.'])

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

                    <h4>Détails de la demande d'AMM <strong>N° {{ $amm->getNumDemande() }}</strong> </h4>

                    <ul class="nav nav-tabs mt-3" id="border-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#border-home" role="tab" aria-selected="true">
                                <i data-feather="bell"></i>
                                <span>Notifications DGCC</span>
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
                    </ul>
                    <div class="tab-content mb-4" id="border-tabsContent">
                        <div class="tab-pane fade show active" id="border-home" role="tabpanel">

                            <table id="zero-" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Notifications</th>
                                    <th>Statut</th>
                                    <th width="3%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Etat de la demande</td>
                                    <td>
                                        <span class="badge badge-success">{{$amm->getEtat->libelle_user}}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ordre de recette</td>
                                    <td class="row">
                                        @if($amm->haveOrdreRecette())
                                            <a class="col-6" target="_blank" href="{{ route('traitement-amm.dwlord', $amm->slug) }}">
                                                Télécharger l'ordre de recette
                                            </a>
                                            @if($amm->etat == 6)
                                                <a class="col-6" href="{{ route('amm.paiementodr', $amm->slug) }}">
                                                    Joindre la quittance de paiement
                                                </a>
                                            @elseif($amm->etat >= 8 && $amm->etat != 998 && $amm->etat != 999)
                                                <a class="col-6" href="{{ url('/uploads/'.$amm->getContribuable->nif.'/amm_'.$amm->id.'/pj_quittance.pdf')}}" target="_blank">
                                                    Paiement de la quittance déjà effectué
                                                </a>
                                            @endif
                                        @else
                                            N/D
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Document - Autorisation de Mise sur le Marché</td>
                                    <td class="row">
                                        @if($amm->etat == 10)
                                            <a class="col-6" target="_blank" href="{{ route('traitement-amm.dwlamm', $amm->slug) }}">
                                                Télécharger l'AMM
                                            </a>
                                            <a class="col-6" target="_blank" href="{{ route('traitement-amm.dwlanx', $amm->slug) }}">
                                                Télécharger les annexes
                                            </a>
                                        @else
                                            N/D
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane fade" id="border-voyage" role="tabpanel">

                            <div class="form-row mb-2">
                                <div class="col-6 input-group-sm">
                                    <label for="paysprov">Pays de provenance</label>
                                    <input type="text" readonly value="{{$amm->paysprov}}" name="paysprov" id="paysprov" class="form-control" />
                                </div>
                                <div class="col-6 input-group-sm">
                                    <label for="modetransport">Mode de transport</label>
                                    <input type="text" readonly value="{{$amm->modetransport}}" name="modetransport" id="modetransport" class="form-control" />
                                </div>
                            </div>
                            @if($amm->modetransport == "Aérienne")
                                @foreach($amm->getVols as $amm_vol)
                                    <div class="form-row mb-2 aerienne">
                                        <div class="col-4 input-group-sm">
                                            <label for="numlta">N° LTA</label>
                                            <input readonly value="{{$amm_vol->numlta}}" type="text" name="numlta" id="numlta" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="cieaerien">Compagnie aérienne</label>
                                            <input readonly value="{{$amm_vol->cieaerien}}" type="text" name="cieaerien" id="cieaerien" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="numvol">N° vol</label>
                                            <input readonly value="{{$amm_vol->numvol}}" type="text" name="numvol" id="numvol" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($amm->modetransport == "Maritime")
                                @foreach($amm->getConteneurs as $amm_cont)
                                    <div class="form-row mb-2 maritime">
                                        <div class="col-2 input-group-sm">
                                            <label for="nomnavire">Nom du navire</label>
                                            <input readonly value="{{$amm_cont->nomnavire}}" type="text" required name="nomnavire" id="nomnavire" class="form-control" />
                                        </div>
                                        <div class="col-2 input-group-sm">
                                            <label for="numvoyagem">N° voyage</label>
                                            <input readonly value="{{$amm_cont->numvoyage}}" type="text" name="numvoyagem" id="numvoyagem" class="form-control" />
                                        </div>
                                        <div class="col-2 input-group-sm">
                                            <label for="numbietc">N° BIETC</label>
                                            <input readonly value="{{$amm_cont->numbietc}}" type="text" name="numbietc" id="numbietc" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="numconnaissement">N° connaissement</label>
                                            <input readonly value="{{$amm_cont->numconnaissement}}" type="text" required name="numconnaissement" id="numconnaissement" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="numconteneurm">N° conteneur</label>
                                            <input readonly value="{{$amm_cont->numconteneur}}" type="text" required name="numconteneurm" id="numconteneurm" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($amm->modetransport == "Terrestre")
                                @foreach($amm->getVehicules as $amm_veh)
                                    <div class="form-row mb-2 terrestre">
                                        <div class="col-4 input-group-sm">
                                            <label for="numlvi">N° LVI</label>
                                            <input readonly value="{{$amm_veh->numlvi}}" type="text" name="numlvi" id="numlvi" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="numvehicule">N° véhicule</label>
                                            <input readonly value="{{$amm_veh->numvehicule}}" type="text" name="numvehicule" id="numvehicule" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="numconteneurt">N° conteneur (si disponible)</label>
                                            <input readonly value="{{$amm_veh->numconteneur}}" type="text" name="numconteneurt" id="numconteneurt" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if($amm->modetransport == "Ferroviaire")
                                <div class="form-row mb-2 ferroviaire">
                                    <div class="col-6 input-group-sm">
                                        <label for="numwagon">N° Wagon</label>
                                        <input readonly value="{{$amm->numwagon}}" type="text" name="numwagon" id="numwagon" class="form-control" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="numvoyagef">N° voyage</label>
                                        <input readonly value="{{$amm->numvoyagef}}" type="text" name="numvoyagef" id="numvoyagef" class="form-control" />
                                    </div>
                                </div>
                            @endif
                            <div class="form-row mb-2">
                                <div class="col-6 input-group-sm">
                                    <label for="dateembarque">Date embarquement</label>
                                    <input type="date" readonly value="{{$amm->dateembarque}}" name="dateembarque" id="dateembarque" class="form-control" />
                                </div>
                                <div class="col-6 input-group-sm">
                                    <label for="lieuembarque">Lieu embarquement</label>
                                    <input type="text" readonly value="{{$amm->lieuembarque}}" name="lieuembarque" id="lieuembarque" class="form-control" />
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <div class="col-6 input-group-sm">
                                    <label for="datedebarque">Date débarquement</label>
                                    <input type="date" readonly value="{{$amm->datedebarque}}" name="datedebarque" id="datedebarque" class="form-control" />
                                </div>
                                <div class="col-6 input-group-sm">
                                    <label for="lieudebarque">Lieu débarquement</label>
                                    <input type="text" readonly value="{{$amm->lieudebarque}}" name="lieudebarque" id="lieudebarque" class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="border-produit" role="tabpanel">

                            @foreach($amm->getProduitAmms as $amms_produit)
                                <h6><u>Informations Produit {{ 1 + $loop->index }}</u></h6>
                                <div class="form-row mb-4">
                                    <div class="col-2 input-group-sm">
                                        <label for="numfact">N° facture</label>
                                        <input type="text" readonly value="{{$amms_produit->numfact}}" name="numfact" id="numfact" class="form-control" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="datefact">Date de facture</label>
                                        <input type="date" readonly value="{{$amms_produit->datefact}}" name="datefact" id="datefact" class="form-control" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="fournisseur">Nom du fournisseur</label>
                                        <input type="text" readonly value="{{$amms_produit->fournisseur}}" name="fournisseur" id="fournisseur" class="form-control" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="paysorig">Pays d'origine</label>
                                        <input type="text" readonly value="{{$amms_produit->paysorig}}" name="paysorig" id="pays_or" class="form-control" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="idproduit">Produit</label>
                                        <input type="text" readonly value="{{$amms_produit->getProduit->libelle}}" name="marque" id="marque" class="form-control" />
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <label for="marque">Marque</label>
                                        <input type="text" readonly value="{{$amms_produit->marque}}" name="marque" id="marque" class="form-control" />
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <label for="poids">Poids (Kg)</label>
                                        <input type="text" readonly value="{{ number_format($amms_produit->poids, 0, ',', ' ') }}" name="poids" min="0" id="poids" class="form-control" onblur="getProduit(this.name, this.value)" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="total">Montant</label>
                                        <input type="text" readonly value="{{ number_format($amms_produit->total, 0, ',', ' ') }}" name="total" id="total" class="form-control" />
                                    </div>
                                </div>
                                <hr >
                            @endforeach
                            <div class="form-row mb-2">
                                <div class="col-3 input-group-sm">
                                    <label for="valeurcaf_ext">Valeur CAF totale (Devise)</label>
                                    <input type="text" readonly value="{{ number_format($amm->valeurcaf_ext, 0, ',', ' ') }}" name="valeurcaf_ext" min="0" id="valeurcaf_ext" class="form-control calculproduit" />
                                </div>
                                <div class="col-2 input-group-sm">
                                    <label for="valeurcaf_dev">Devise</label>
                                    <input type="text" readonly value="{{ $amm->valeurcaf_dev }}" name="valeurcaf_dev" min="0" id="valeurcaf_ext" class="form-control calculproduit" />
                                </div>
                                <div class="col-3"></div>
                                <div class="col-4 input-group-sm">
                                    <label for="valeurcaf_cfa">Valeur CAF totale (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amm->valeurcaf_cfa, 0, ',', ' ') }}" name="valeurcaf_dev" min="0" id="valeurcaf_ext" class="form-control calculproduit" />
                                </div>
                            </div>
                            <hr />
                            <div class="form-row mb-2">
                                <div class="col-3 input-group-sm"></div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalpoids">Poids total (Kg)</label>
                                    <input type="text" readonly value="{{ number_format($amm->totalpoids, 0, ',', ' ') }}" name="totalpoids" id="totalpoids" class="form-control" />
                                </div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalfrais">Frais à payer (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amm->totalfrais, 0, ',', ' ') }}" name="totalfrais" id="totalfrais" class="form-control" />
                                </div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalenr">Frais d'enregistrement (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amm->totalenr, 0, ',', ' ') }}" name="totalenr" id="totalenr" class="form-control" />
                                </div>
                            </div>
                            <hr />
                            <div class="form-row mb-2">
                                <div class="col-9 input-group-sm"></div>
                                <div class="col-3 input-group-sm">
                                    <label for="totalglobal">Total des frais (F CFA)</label>
                                    <input type="text" readonly value="{{ number_format($amm->totalglobal, 0, ',', ' ') }}" name="totalglobal" id="totalglobal" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="border-pj" role="tabpanel">
                            @foreach($amm->getDocumentAmms as $amms_doc)
                                <div class="form-row mb-2">
                                    <div class="col-10 input-group-sm">
                                        {{  $amms_doc->libelle }}
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <a href="{{ url('/uploads/'.$amm->getContribuable->nif.'/amm_'.$amm->id.'/'.$amms_doc->pj)}}" target="_blank"> <i data-feather="link"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
