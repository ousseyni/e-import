@extends('layouts.app', ['page_name' => 'Mes demandes',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.M.'])

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-10 col-lg-10 col-sm-10  layout-spacing">
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

                        <h3>Détails de la demande d'AMM {{ $amm->getNumDemande() }}</h3>

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
                                            <td>N/D</td>
                                        </tr>
                                        <tr>
                                            <td>Document - Autorisation de Mise sur le Marché</td>
                                            <td>N/D</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="border-voyage" role="tabpanel">

                                <div class="form-row mb-2">
                                    <div class="col-4 input-group-sm">
                                        <label for="numfact">N° Facture</label>
                                        <input type="text" readonly value="{{$amm->numfact}}" name="numfact" id="numfact" class="form-control" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="datefact">Date Facture</label>
                                        <input type="date" readonly value="{{$amm->datefact}}" name="datefact" id="datefact" class="form-control" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="fournisseur">Nom Fournisseur</label>
                                        <input type="text" readonly value="{{$amm->fournisseur}}" name="fournisseur" id="fournisseur" class="form-control" />
                                    </div>
                                </div>
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
                                    <div class="form-row mb-2 aerienne">
                                        <div class="col-6 input-group-sm">
                                            <label for="cieaerien">Compagnie aérienne</label>
                                            <input readonly value="{{$amm->cieaerien}}" type="text" name="cieaerien" id="cieaerien" class="form-control" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="numvoyagea">N° vol</label>
                                            <input readonly value="{{$amm->numvoyagea}}" type="text" name="numvoyagea" id="numvoyagea" class="form-control" />
                                        </div>
                                    </div>
                                @endif
                                @if($amm->modetransport == "Maritime")
                                    <div class="form-row mb-2 maritime">
                                        <div class="col-6 input-group-sm">
                                            <label for="nomnavire">Nom du navire</label>
                                            <input readonly value="{{$amm->nomnavire}}" type="text" name="nomnavire" id="nomnavire" class="form-control" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="numvoyagem">N° voyage</label>
                                            <input readonly value="{{$amm->numvoyagem}}" type="text" name="numvoyagem" id="numvoyagem" class="form-control" />
                                        </div>
                                    </div>
                                @endif
                                @if($amm->modetransport == "Terrestre")
                                    <div class="form-row mb-2 terrestre">
                                        <div class="col-6 input-group-sm">
                                            <label for="numvehicul">N° véhicule</label>
                                            <input readonly value="{{$amm->numvehicul}}" type="text" name="numvehicul" id="numvehicul" class="form-control" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="numvoyaget">N° voyage</label>
                                            <input readonly value="{{$amm->numvoyaget}}" type="text" name="numvoyaget" id="numvoyaget" class="form-control" />
                                        </div>
                                    </div>
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
                                        <label for="numconteneur">N° conteneur</label>
                                        <input type="text" readonly value="{{$amm->numconteneur}}" name="numconteneur" id="numconteneur" class="form-control" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="numconnaissement">N° connaissement</label>
                                        <input type="text" readonly value="{{$amm->numconnaissement}}" name="numconnaissement" id="numconnaissement" class="form-control" />
                                    </div>
                                </div>
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
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            <label for="prod{{ $loop->index }}">Produit {{ $loop->index }}</label>
                                            <input type="text" readonly value="{{$amms_produit->getProduit->libelle}}" id="prod{{ $loop->index }}" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="poids{{ $loop->index }}">Poids total (Kg)</label>
                                            <input type="number" readonly value="{{$amms_produit->poids}}" id="poids{{ $loop->index }}" class="form-control calculproduit" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="total{{ $loop->index }}">Montant (F CFA)</label>
                                            <input type="number" readonly value="{{$amms_produit->total}}" id="total{{ $loop->index }}" class="form-control" />
                                        </div>
                                    </div>
                                @endforeach
                                <hr />
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        <label for="valeurcaf">Valeur CAF totale (F CFA)</label>
                                        <input readonly value="{{$amm->valeurcaf}}" type="number" name="valeurcaf" value="0" min="0" id="valeurcaf" class="form-control calculproduit" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="consoservice">Consommables & services (F CFA)</label>
                                        <input readonly value="{{$amm->consoservice}}" type="number" name="consoservice" value="0" min="0" id="consoservice" class="form-control calculproduit" />
                                    </div>
                                </div>
                                <hr />
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm"></div>
                                    <div class="col-3 input-group-sm">
                                        <label for="totalpoids">Poids Total (Kg)</label>
                                        <input readonly value="{{$amm->totalpoids}}" type="number" name="totalpoids" id="totalpoids" class="form-control" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="totalamm">Montant Total (F CFA)</label>
                                        <input readonly value="{{$amm->totalamm}}" type="number" name="totalamm" id="totalamm" class="form-control" />
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
                                        <a href="{{ url('/uploads/'.$amm->getContribuable->nif.'/'.$amms_doc->pj)}}" target="_blank"> <i data-feather="link"></i></a>
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
