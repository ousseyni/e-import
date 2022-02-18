@extends('layouts.app', ['page_name' => 'Mes demandes',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.M.'])

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-10 col-lg-10 col-sm-10  layout-spacing">
                <div class="widget-content widget-content-area br-6">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif

                    <div class="widget-content widget-content-area">

                        <div id="example-show">
                            <h3>Informations Voyage</h3>
                            <section>
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
                                        <label for="paysorig">Pays d'origine</label>
                                        <input type="text" readonly value="{{$amm->paysorig}}" name="paysorig" id="paysorig" class="form-control" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="paysprov">Pays de provenance</label>
                                        <input type="text" readonly value="{{$amm->paysprov}}" name="paysprov" id="paysprov" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        <label for="nomnavire">Nom du navire</label>
                                        <input type="text" readonly value="{{$amm->nomnavire}}" name="nomnavire" id="nomnavire" class="form-control" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="cieaerien">Compagnie aérienne</label>
                                        <input type="text" readonly value="{{$amm->cieaerien}}" name="cieaerien" id="cieaerien" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        <label for="numvehicul">N° véhicule</label>
                                        <input type="text" readonly value="{{$amm->numvehicul}}" name="numvehicul" id="numvehicul" class="form-control" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="numvoyage">N° vol ou voyage</label>
                                        <input type="text" readonly value="{{$amm->numvoyage}}" name="numvoyage" id="numvoyage" class="form-control" />
                                    </div>
                                </div>
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
                            </section>
                            <h3>Informations Produits</h3>
                            <section>
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
                                        <input type="number" name="valeurcaf" value="0" min="0" id="valeurcaf" class="form-control calculproduit" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="consoservice">Consommables & services (F CFA)</label>
                                        <input type="number" name="consoservice" value="0" min="0" id="consoservice" class="form-control calculproduit" />
                                    </div>
                                </div>
                                <hr />
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm"></div>
                                    <div class="col-3 input-group-sm">
                                        <label for="totalpoids">Poids Total Produits (Kg)</label>
                                        <input type="number" readonly name="totalpoids" id="totalpoids" class="form-control" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="totalamm">Montant Total Produits (F CFA)</label>
                                        <input type="number" readonly name="totalamm" id="totalamm" class="form-control" />
                                    </div>
                                </div>
                            </section>
                            <h3>Pièces Justificatives</h3>
                            <section>
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        Joindre la Facture Fournisseur
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj1" name="pj1" />
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        Joindre la Fiche Sécurité
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj2" name="pj2" />
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        Joindre le Certificat Conformité
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj3" name="pj3" />
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        Joindre CNT/LTA/LV
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj4" name="pj4" />
                                    </div>
                                </div>
                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        Joindre le Certificat d'origine
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj5" name="pj5" />
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
