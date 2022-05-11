@extends('layouts.app', ['page_name' => "Rapport d'inspection",
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Traitement des A.M.M.'])

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
                        <h5>Rapport d'inspection - AMM N° : {{ $amm->getNumDemande() }}</h5><br>
                        <form method="post" id="form-amm-amc" action="{{ route('traitement-amm.saverapport', $amm) }}" enctype="multipart/form-data">
                            @csrf
                            <div id="example-basic">
                                <h3>Informations importation</h3>
                                <section>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            <label for="imp">Importateur</label>
                                            <input readonly id="imp" type="text" value="{{ $contribuable->raisonsociale }}" class="form-control" />
                                            <input type="hidden" name="slugamm" value="{{ $amm->slug }}" />
                                            <input type="hidden" name="idcontribuable" value="{{ $contribuable->id }}" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="acti">Activité</label>
                                            <input readonly id="acti" type="text" value="{{ (is_null($contribuable->activiteid) ? '' : $contribuable->getActivite->libelle) }}" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="nif">N° Stat</label>
                                            <input id="nif" readonly value="{{ $contribuable->nif }}" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="bp">BP</label>
                                            <input id="bp" readonly value="{{ $contribuable->bp }}" class="form-control" />
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="tel">Tél</label>
                                            <input id="tel" readonly value="{{ $contribuable->tel }}" type="text"class="form-control" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-row mb-2">
                                        <div class="col-4 input-group-sm">
                                            <label for="paysprov">Pays de provenance</label>
                                            <select required class="form-control" id="paysprov" name="paysprov">
                                                @foreach($pays_pr as $pays)
                                                    <option value="{{$pays->libelle}}" {{ ($pays->libelle == $amm->paysprov ? 'selected' : '') }} >{{$pays->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="modetransport">Mode de transport</label>
                                            <select required class="form-control" id="modetransport" name="modetransport">
                                                @foreach($mode_t as $mode)
                                                    <option value="{{$mode->libelle}}" {{ ($mode->libelle == $amm->modetransport ? 'selected' : '') }} >{{$mode->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4 input-group-sm">
                                            <label for="conditiontransport">Condition de transport et/ou d'entreposage</label>
                                            <select required class="form-control" id="conditiontransport" name="conditiontransport">
                                                @foreach($conditions_tp as $condition)
                                                    <option value="{{$condition}}">{{$condition}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            <label for="poinentree">Point d'entrée déclaré</label>
                                            <input value="{{ $amm->lieudebarque }}" type="text" required name="poinentree" id="poinentree" class="form-control" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="lieuinspection">Lieu de l'inspection</label>
                                            <input type="text" value="{{ $contribuable->localisation }}" required name="lieuinspection" id="lieuinspection" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="col-6 input-group-sm">
                                            <label for="natureproduits">Nature des produits</label>
                                            <input type="text" required name="natureproduits" id="natureproduits" class="form-control" />
                                        </div>
                                        <div class="col-6 input-group-sm">
                                            <label for="totalqte">Quantité totale (Kg)</label>
                                            <input type="number" min="0" value="{{ $amm->totalpoids }}" required name="totalqte" id="totalqte" class="form-control" />
                                        </div>
                                    </div>
                                    <hr>
                                    @if($amm->modetransport != 'Aérien')
                                        <div class="form-row mb-1">
                                            @foreach($conteneursAmm as $conteneur)
                                                <div class="col-5 input-group-sm">
                                                    <label for="conteneurinspecte_{{$loop->index}}">N° conteneur</label>
                                                    <input type="text" value="{{$conteneur->numconteneur}}" name="conteneurinspecte_{{$loop->index}}" id="conteneurinspecte_{{$loop->index}}" class="form-control" />
                                                </div>
                                                <div class="col-5 input-group-sm">
                                                    <label for="numeroplomb_{{$loop->index}}">N° Plomb</label>
                                                    <input type="text" value="{{$conteneur->numplomb}}" name="numeroplomb_{{$loop->index}}" id="numeroplomb_{{$loop->index}}" class="form-control" />
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="form-group conteneur-repeater">
                                            <div data-repeater-list="conteneurs">
                                                <div class="repeater_item_conteneurs" data-repeater-item>
                                                    <div class="form-row mb-1">
                                                        <div class="col-5 input-group-sm">
                                                            <label for="conteneurinspecte">N° conteneur</label>
                                                            <input type="text" required name="conteneurinspecte" id="conteneurinspecte" class="form-control" />
                                                        </div>
                                                        <div class="col-5 input-group-sm">
                                                            <label for="numeroplomb">N° Plomb</label>
                                                            <input type="text" required name="numeroplomb" id="numeroplomb" class="form-control" />
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
                                                        <i class="icon-plus4"></i> Ajouter d'autres conteneurs
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                </section>
                                <h3>Eléments à inspecter</h3>
                                <section>

                                    <div class="form-group produit-repeater">
                                        <div data-repeater-list="produits">
                                            <div class="input-group repeater_item_produits" data-repeater-item>
                                                <div class="form-row mb-4">
                                                    <div class="col-4 input-group-sm">
                                                        <label for="idproduit">Produits à inspecter</label>
                                                        <select class="form-control" required id="idproduitamm" name="idproduitamm" onblur="getProduit(this.name, this.value)">
                                                            <option value="">-- Sélectionner --</option>
                                                            @foreach($categorie_produits as $categorie)
                                                                <optgroup label="{{str_replace("\\","", $categorie->libelle)}}">
                                                                    @foreach($categorie->getProduits as $produit)
                                                                        @if(in_array($produit->id, $tab_pamm))
                                                                            <option value="{{$produit->id}}"><strong>{{str_replace("\\","", $produit->libelle)}}</strong></option>
                                                                        @else
                                                                            <option value="{{$produit->id}}">{{str_replace("\\","", $produit->libelle)}}</option>
                                                                        @endif
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
                                                        <label for="numerolot">N° Lot</label>
                                                        <input type="text"name="numerolot" id="numerolot" class="form-control" />
                                                    </div>
                                                    <div class="col-4 input-group-sm">
                                                        <label for="paysorig">Origine</label>
                                                        <select class="form-control" id="paysorig" name="paysorig">
                                                            @foreach($pays_or as $pays)
                                                                <option value="{{$pays->libelle}}">{{$pays->libelle}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="fabricant">Fabricant/Fournisseur</label>
                                                        <input type="text" required="" name="fabricant" id="fabricant" class="form-control" />
                                                    </div>
                                                    <div class="col-4 input-group-sm">
                                                        <label for="ingredients">Ingrédients</label>
                                                        <input type="text" name="ingredients" id="ingredients" class="form-control" />
                                                    </div>
                                                    <div class="col-2 input-group-sm">
                                                        <label for="qtenet">Poids/Volume net</label>
                                                        <input type="number" required="" name="qtenet" min="0" id="qtenet" class="form-control" onblur="getProduit(this.name, this.value)" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="durabilite">Durabilité (DLC/DLUO)</label>
                                                        <input required type="text" name="durabilite" id="durabilite" class="form-control" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="modeemploi">Mode d'emploi</label>
                                                        <input type="text" name="modeemploi" id="modeemploi" class="form-control" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="allegation">Allégation</label>
                                                        <input type="text" name="allegation" id="allegation" class="form-control" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="possede2aire">Avec emballage II aire ?</label><br>
                                                        Oui <input required type="radio" value="1" name="possede2aire" id="possede2aire" />
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        Non <input required type="radio" value="0" name="possede2aire" id="possede2aire" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="etat2aire">Emballage II aire intacte ?</label><br>
                                                        Oui <input required type="radio" value="1" name="etat2aire" id="etat2aire" />
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        Non <input required type="radio" value="0" name="etat2aire" id="etat2aire" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="possede1aire">Avec emballage I aire ?</label><br>
                                                        Oui <input required type="radio" value="0" name="possede1aire" id="possede1aire" />
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        Non <input required type="radio" value="1" name="possede1aire" id="possede1aire" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="etat1aire">Emballage I aire intacte ?</label> <br>
                                                        Oui <input required type="radio" value="1" name="etat1aire" id="etat1aire" />
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        Non <input required type="radio" value="0" name="etat1aire" id="etat1aire" />
                                                    </div>
                                                    <div class="col-3 input-group-sm">
                                                        <label for="autreobservation">Autres observations</label>
                                                        <input type="text" name="autreobservation" id="autreobservation" class="form-control" />
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

                                </section>
                                <h3>Conclusion finale</h3>
                                <section>
                                    <div class="form-row mb-2">
                                        <div class="col-5 input-group-sm">
                                            <label for="conclusion">Le(s) produit(s) inspecté(s) est(sont) conforme(s) ?</label> <br>
                                            Oui <input checked type="radio" value="1" name="conclusion" id="conclusion" />
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Non <input type="radio" value="0" name="conclusion" id="conclusion" />
                                        </div>
                                        <div class="col-7 input-group-sm">
                                            <label for="observation">Observation générale</label>
                                            <textarea class="form-control" required name="observation" id="observation"></textarea>
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
