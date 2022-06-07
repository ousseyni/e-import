@extends('layouts.app', ['page_name' => 'Nouvelle demande',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.C.'])

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
                        <h5>Nouvelle demande AMC</h5><br>
                        <form method="post" id="form-amm-amc" action="{{ route('amc.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div id="example-basic">
                                <h3>Informations voyage</h3>
                                <section>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            <label for="paysprov">Pays de provenance</label>
                                            <select class="form-control " id="paysprov" name="paysprov">
                                                @foreach($pays_pr as $pays)
                                                    <option value="{{$pays->libelle}}">{{$pays->libelle}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="idcontribuable" id="idcontribuable" value="{{ $contribuable->id }}" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="paysorig">Mode de transport</label>
                                            <select class="form-control" id="modetransport" name="modetransport">
                                                @foreach($mode_t as $mode_t)
                                                    <option value="{{$mode_t->libelle}}">{{$mode_t->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mb-2 aerienne">
                                        <div class="col-4 input-group-sm">
                                            <label for="numlta">N° LTA</label>
                                            <input type="text" name="numlta" id="numlta" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="cieaerien">Compagnie aérienne</label>
                                            <input type="text" name="cieaerien" id="cieaerien" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="numvol">N° vol</label>
                                            <input type="text" name="numvol" id="numvol" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2 maritime" style="display: none">
                                        <div class="col-3 input-group-sm">
                                            <label for="nomnavire">Nom du navire</label>
                                            <input type="text" required name="nomnavire" id="nomnavire" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="numvoyagem">N° voyage</label>
                                            <input type="text" name="numvoyagem" id="numvoyagem" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="numbietc">N° BIETC</label>
                                            <input type="text" name="numbietc" id="numbietc" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="numconnaissement">N° connaissement</label>
                                            <input type="text" required name="numconnaissement" id="numconnaissement" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group conteneur-repeater maritime" style="display: none;">
                                        <div data-repeater-list="conteneurs">
                                            <div class="repeater_item_conteneurs" data-repeater-item>
                                                <div class="form-row mb-4">
                                                    <div class="col-5 input-group-sm">
                                                        <label for="numconteneurm">N° conteneur</label>
                                                        <input type="text" required name="numconteneurm" id="numconteneurm" class="form-control" />
                                                    </div>
                                                    <div class="col-5 input-group-sm">
                                                        <label for="numplombm">N° plomb</label>
                                                        <input type="text" required name="numplombm" id="numplombm" class="form-control" />
                                                    </div>
                                                    <div class="col-2 input-group-sm" style="padding-top: 3.3%">
                                                        <a class="btn btn-danger  btn-sm" data-repeater-delete="">x</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <button type="button" data-repeater-create class="btn btn-primary btn-sm">
                                                    <i class="icon-plus4"></i> Ajouter un conteneur
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group vehicule-repeater terrestre" style="display: none;">
                                        <div data-repeater-list="vehicules">
                                            <div class="repeater_item_vehicules" data-repeater-item>
                                                <div class="form-row mb-4">
                                                    <div class="col-3 input-group-sm">
                                                        <label for="numlvi">N° LVI</label>
                                                        <input type="text" name="numlvi" id="numlvi" class="form-control" />
                                                    </div>
                                                    <div class="col-2 input-group-sm">
                                                        <label for="numvehicule">N° véhicule</label>
                                                        <input type="text" name="numvehicule" id="numvehicule" class="form-control" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="numconteneurt">N° conteneur (si disponible)</label>
                                                        <input type="text" name="numconteneurt" id="numconteneurt" class="form-control" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="numplombt">N° plomb (si disponible)</label>
                                                        <input type="text" name="numplombt" id="numplombt" class="form-control" />
                                                    </div>
                                                    <div class="col-1 input-group-sm" style="padding-top: 3.3%">
                                                        <a class="btn btn-danger  btn-sm" data-repeater-delete="">x</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <button type="button" data-repeater-create class="btn btn-primary btn-sm">
                                                    <i class="icon-plus4"></i> Ajouter un véhicule
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-2 terrestre" style="display: none">

                                    </div>
                                    <!--div class="form-row mb-2 ferroviaire" style="display: none">
                                        <div class="col-6 input-group-sm">
                                            <label for="numvoyagef">N° voyage</label>
                                            <input type="text" name="numvoyagef" id="numvoyagef" class="form-control" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="numwagon">N° Wagon</label>
                                            <input type="text" name="numwagon" id="numwagon" class="form-control" />
                                        </div>
                                    </div-->
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
                                <h3>Informations produits</h3>
                                <section>

                                    <div class="form-group produit-repeater">
                                        <div data-repeater-list="produits">
                                            <div class="input-group repeater_item_produits" data-repeater-item>
                                                <div class="form-row mb-4">
                                                    <div class="col-2 input-group-sm">
                                                        <label for="numfact">N° facture</label>
                                                        <input type="text" required="" name="numfact" id="numfact" class="form-control" />
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
                                                        <select class="form-control" id="pays_or" name="pays_or">
                                                            @foreach($pays_or as $pays)
                                                                <option value="{{$pays->libelle}}">{{$pays->libelle}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-4 input-group-sm">
                                                        <label for="idproduit">Produit</label>
                                                        <select class="form-control" required="" id="idproduit" name="idproduit" onblur="getProduit(this.name, this.value)">
                                                            <option value="">-- Sélectionner --</option>
                                                            @foreach($categorie_produits as $categorie)
                                                                <optgroup label="{{str_replace("\\","", $categorie->libelle)}}">
                                                                    @foreach($categorie->getProduits as $produit)
                                                                        <option value="{{$produit->id}}">{{str_replace("\\","", $categorie->libelle)}} > {{str_replace("\\","", $produit->libelle)}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-2 input-group-sm">
                                                        <label for="marque">Marque</label>
                                                        <input type="text"name="marque" id="marque" class="form-control" />
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
                                                        <a class="btn btn-danger  btn-sm" data-repeater-delete="">x</a>
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
                                        <div class="col-3 input-group-sm">
                                            <label for="valeurcaf_ext">Valeur CAF totale (Devise)</label>
                                            <input type="number" name="valeurcaf_ext" value="0" min="0" id="valeurcaf_ext" class="form-control calculproduit" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="valeurcaf_dev">Devise</label>
                                            <select class="form-control" id="valeurcaf_dev" name="valeurcaf_dev">
                                                @foreach($tab_devise as $devise)
                                                    <option value="{{$devise->code}}">{{$devise->code.' - '.$devise->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-4 input-group-sm">
                                            <label for="valeurcaf_cfa">Valeur CAF totale (F CFA)</label>
                                            <input type="number" name="valeurcaf_cfa" value="0" min="0" id="valeurcaf_cfa" class="form-control calculproduit" />
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-row mb-2">
                                        <div class="col-3 input-group-sm"></div>
                                        <div class="col-3 input-group-sm">
                                            <label for="totalpoids">Poids total (Kg)</label>
                                            <input type="number" readonly name="totalpoids" id="totalpoids" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="totalfrais">Montant total (F CFA)</label>
                                            <input type="number" readonly name="totalfrais" id="totalfrais" class="form-control" />
                                        </div>
                                        <div class="col-3 input-group-sm">
                                            <label for="totalenr">Frais d'enregistrement (F CFA)</label>
                                            <input type="number" readonly name="totalenr" id="totalenr" class="form-control" />
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-row mb-2">
                                        <div class="col-9 input-group-sm"></div>
                                        <div class="col-3 input-group-sm">
                                            <label for="totalglobal">Frais total à payer (F CFA)</label>
                                            <input type="number" readonly name="totalglobal" id="totalglobal" class="form-control" />
                                        </div>
                                    </div>
                                </section>
                                <h3>Pièces justificatives</h3>
                                <section>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre les factures fournisseurs
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" required="" multiple accept=".pdf, .jpg, .png, .jpeg" id="pj1" name="pj1[]" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre le certificat sanitaire
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj2" name="pj2" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre CNT/LTA/LVI
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj3" name="pj3" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre le certificat d'origine
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj4" name="pj4" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre l'Autorisation Spéciale des Lubrifiants (AIL)
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj6" name="pj6" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre l'Autorisation Spéciale d'Importation (ASI)
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj7" name="pj7" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre l'Autorisation Spéciale d'Importation des produits réglementés (SAO & GES)
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj8" name="pj8" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre la licence de détention/utilisation des substances réglementées  (SAO & GES)
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj9" name="pj9" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre le certificat de fumigation (riz & friperie)
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj10" name="pj10" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            Joindre le B.I.E.T.C.
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <input type="file" accept=".pdf, .jpg, .png, .jpeg" id="pj11" name="pj11" />
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
