@extends('layouts.app', ['page_name' => 'Nouvelle demande',
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

                        <form method="post" id="form-amm-amc" action="{{ route('amm.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div id="example-basic">
                                <h3>Informations Voyage</h3>
                                    <section>
                                        <div class="form-row mb-2">
                                            <div class="col-4 input-group-sm">
                                                <label for="numfact">N° Facture</label>
                                                <input type="text" required="" name="numfact" id="numfact" class="form-control" />
                                                <input type="hidden" name="idcontribuable" id="idcontribuable" value="{{ $contribuable->id }}" />
                                            </div>
                                            <div class="col-4 input-group-sm">
                                                <label for="datefact">Date Facture</label>
                                                <input type="date" required="" name="datefact" id="datefact" class="form-control" />
                                            </div>
                                            <div class="col-4 input-group-sm">
                                                <label for="fournisseur">Nom Fournisseur</label>
                                                <input type="text" required="" name="fournisseur" id="fournisseur" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="paysorig">Pays d'origine</label>
                                                <select class="form-control basic" id="paysorig" name="paysorig">
                                                    @foreach($pays_or as $pays)
                                                        <option value="{{$pays->libelle}}">{{$pays->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="paysprov">Pays de provenance</label>
                                                <select class="form-control basic2" id="paysorig" name="paysprov">
                                                    @foreach($pays_pr as $pays)
                                                        <option value="{{$pays->libelle}}">{{$pays->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="nomnavire">Nom du navire</label>
                                                <input type="text" required name="nomnavire" id="nomnavire" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="cieaerien">Compagnie aérienne</label>
                                                <input type="text" name="cieaerien" id="cieaerien" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="numvehicul">N° véhicule</label>
                                                <input type="text" name="numvehicul" id="numvehicul" class="form-control" />
                                            </div>
                                            <div class="col-6 input-group-sm">
                                                <label for="numvoyage">N° vol ou voyage</label>
                                                <input type="text" name="numvoyage" id="numvoyage" class="form-control" />
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
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="prodA">Produit A</label>
                                                <select class="form-control calculproduit" required="" id="prodA" name="prodA">
                                                    <option value="">-- Sélectionner un produit --</option>
                                                    @foreach($produits_a as $produits)
                                                        <option value="{{$produits->id}}">{{$produits->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="poidsA">Poids total (Kg)</label>
                                                <input type="number" required="" name="poidsA" min="0" id="poidsA" class="form-control calculproduit" />
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="totalA">Montant (F CFA)</label>
                                                <input type="number" readonly name="totalA" id="totalA" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="prodB">Produit B</label>
                                                <select class="form-control calculproduit" id="prodB" name="prodB">
                                                    <option value="">-- Sélectionner un produit --</option>
                                                    @foreach($produits_b as $produits)
                                                        <option value="{{$produits->id}}">{{$produits->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="poidsB">Poids total (Kg)</label>
                                                <input type="number" name="poidsB" id="poidsB" min="0" class="form-control calculproduit" />
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="totalB">Montant (F CFA)</label>
                                                <input type="number" readonly name="totalB" id="totalB" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="prodA">Produit C</label>
                                                <select class="form-control calculproduit" id="prodC" name="prodC">
                                                    <option value="">-- Sélectionner un produit --</option>
                                                    @foreach($produits_c as $produits)
                                                        <option value="{{$produits->id}}">{{$produits->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <hr />
                                            <div class="col-3 input-group-sm">
                                                <label for="poidsC">Poids total (Kg)</label>
                                                <input type="number" name="poidsC" id="poidsC" min="0" class="form-control calculproduit" />
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="totalC">Montant (F CFA)</label>
                                                <input type="number" readonly name="totalC" id="totalC" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-6 input-group-sm">
                                                <label for="prodD">Produit D</label>
                                                <select class="form-control calculproduit" id="prodD" name="prodD">
                                                    <option value="">-- Sélectionner un produit --</option>
                                                    @foreach($produits_d as $produits)
                                                        <option value="{{$produits->id}}">{{$produits->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="poidsD">Poids total (Kg)</label>
                                                <input type="number" name="poidsD" id="poidsD" min="0" class="form-control calculproduit" />
                                            </div>
                                            <div class="col-3 input-group-sm">
                                                <label for="totalD">Montant (F CFA)</label>
                                                <input type="number" readonly name="totalD" id="totalD" class="form-control" />
                                            </div>
                                        </div>
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

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('change', '.calculproduit', function () {
            getProduit();
        });

        $('body').on('blur', '.calculproduit', function () {
            getProduit();
        });

    });

</script>
