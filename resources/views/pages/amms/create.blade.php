@extends('layouts.app', ['page_name' => 'Nouvelle demande',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.M.'])

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif

                    <div class="-content widget-content-area">

                        <form method="post" id="form-amm-amc" action="{{ route('amm.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div id="example-basic">
                                <h3>Informations Voyage</h3>
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="paysprov">Pays de provenance</label>
                                                <select class="form-control basic2" id="paysorig" name="paysprov">
                                                    @foreach($pays_pr as $pays)
                                                        <option value="{{$pays->libelle}}">{{$pays->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="paysorig">Mode de transport</label>
                                                <select class="form-control basic" id="modetransport" name="modetransport">
                                                    @foreach($mode_t as $mode_t)
                                                        <option value="{{$mode_t->libelle}}">{{$mode_t->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2 aerienne">
                                            <div class="col-6 input-group-sm">
                                                <label for="cieaerien">Compagnie aérienne</label>
                                                <input type="text" name="cieaerien" id="cieaerien" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="numvoyagea">N° vol</label>
                                                <input type="text" name="numvoyagea" id="numvoyagea" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2 maritime" style="display: none">
                                            <div class="col-6 input-group-sm">
                                                <label for="nomnavire">Nom du navire</label>
                                                <input type="text" required name="nomnavire" id="nomnavire" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="numvoyagem">N° voyage</label>
                                                <input type="text" name="numvoyagem" id="numvoyagem" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2 terrestre" style="display: none">
                                            <div class="col-6 input-group-sm">
                                                <label for="numvehicul">N° véhicule</label>
                                                <input type="text" name="numvehicul" id="numvehicul" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="numvoyaget">N° voyage</label>
                                                <input type="text" name="numvoyaget" id="numvoyaget" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2 ferroviaire" style="display: none">
                                            <div class="col-6 input-group-sm">
                                                <label for="numwagon">N° Wagon</label>
                                                <input type="text" name="numwagon" id="numwagon" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="numvoyagef">N° voyage</label>
                                                <input type="text" name="numvoyagef" id="numvoyagef" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="numconteneur">N° conteneur</label>
                                                <input type="text" required name="numconteneur" id="numconteneur" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="numconnaissement">N° connaissement</label>
                                                <input type="text" required name="numconnaissement" id="numconnaissement" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="dateembarque">Date embarquement</label>
                                                <input type="date" required name="dateembarque" id="dateembarque" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="lieuembarque">Lieu embarquement</label>
                                                <input type="text" required name="lieuembarque" id="lieuembarque" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="datedebarque">Date débarquement</label>
                                                <input type="date" required name="datedebarque" id="datedebarque" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="lieudebarque">Lieu débarquement</label>
                                                <input type="text" required name="lieudebarque" id="lieudebarque" class="form-control" />
                                            </div>
                                        </div>
                                    </section>
                                <h3>Informations Produits</h3>
                                    <section>

                                        <div class="form-group contact-repeater">
                                            <div data-repeater-list="produits">
                                                <div class="input-group repeater_item" data-repeater-item>
                                                    <div class="form-row mb-4">
                                                        <div class="col-2 input-group-sm">
                                                            <label for="numfact">N° facture</label>
                                                            <input type="text" required="" name="numfact" id="numfact" class="form-control" />
                                                            <input type="hidden" name="idcontribuable" id="idcontribuable" value="{{ $contribuable->id }}" />
                                                        </div>
                                                        <div class="col-3 input-group-sm">
                                                            <label for="datefact">Date de facture</label>
                                                            <input type="date" required="" name="datefact" id="datefact" class="form-control" value="{{ date('Y-m-d') }}" />
                                                        </div>
                                                        <div class="col-3 input-group-sm">
                                                            <label for="fournisseur">Nom du fournisseur</label>
                                                            <input type="text" required="" name="fournisseur" id="fournisseur" class="form-control" />
                                                        </div>
                                                        <div class="col-4 input-group-sm">
                                                            <label for="pays_or">Pays d'origine</label>
                                                            <select class="form-control basic2" id="pays_or" name="pays_or">
                                                                @foreach($pays_or as $pays)
                                                                    <option value="{{$pays->libelle}}">{{$pays->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-4 input-group-sm">
                                                            <label for="produit">Produit</label>
                                                            <select class="form-control" required="" id="produit" name="produit" onblur="getProduit(this.name, this.value)">
                                                                <option value="">-- Sélectionner --</option>
                                                                @foreach($categorie_produits as $categorie)
                                                                    <optgroup label="{{str_replace("\\","", $categorie->libelle)}}">
                                                                        @foreach($categorie->getProduits as $produit)
                                                                            <option value="{{$produit->id}}">{{str_replace("\\","", $produit->libelle)}}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2 input-group-sm">
                                                            <label for="marque">Marque</label>
                                                            <input type="text" required="" name="marque" id="marque" class="form-control" />
                                                        </div>
                                                        <div class="col-2 input-group-sm">
                                                            <label for="poids">Poids (Kg)</label>
                                                            <input type="number" required="" name="poids" min="0" id="poids" class="form-control" onblur="getProduit(this.name, this.value)" />
                                                        </div>
                                                        <div class="col-2 input-group-sm">
                                                            <label for="total">Montant</label>
                                                            <input type="number" readonly name="total" id="total" class="form-control" />
                                                        </div>
                                                        <div class="col-2 input-group-sm" style="padding-top: 1.5%">
                                                            <a class="btn btn-danger  btn-sm" data-repeater-delete="">Retirer ce produit</a>
                                                        </div>
                                                    </div>
                                                    <hr >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <button type="button" data-repeater-create class="btn btn-primary btn-sm">
                                                        <i class="icon-plus4"></i> Ajouter un produit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="valeurcaf">Valeur CAF totale (F CFA)</label>
                                                <input type="number" name="valeurcaf" value="0" min="0" id="valeurcaf" class="form-control calculproduit" />
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="totalpoids">Poids total (Kg)</label>
                                                <input type="number" readonly name="totalpoids" id="totalpoids" class="form-control" />
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="totalamm">Frais à payer (F CFA)</label>
                                                <input type="number" readonly name="totalamm" id="totalamm" class="form-control" />
                                            </div>
                                        </div>
                                    </section>
                                <h3>Pièces Justificatives</h3>
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre les factures fournisseurs
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" required="" multiple="" accept=".pdf, .jpg, .png, .jpeg" id="pj1" name="pj1" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre la fiche sécurité
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj2" name="pj2" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre le certificat de conformité
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj3" name="pj3" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre CNT/LTA/LVI
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj4" name="pj4" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre Certificat d'origine
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj5" name="pj5" />
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre l'Autorisation Spéciale des Lubrifiants (AIL)
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj5" name="pj6" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre l'Autorisation Spéciale d'Importation (ASI)
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj5" name="pj7" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre l'Autorisation Spéciale d'Importation des produits réglementés (SAO & GES)
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj5" name="pj8" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre la licence de détention/utilisation des substances réglementées  (SAO & GES)
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj5" name="pj9" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                Joindre le certificat de fumigation (riz & friperie)
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj5" name="pj10" />
                                            </div>
                                        </div>
                                    </section>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
