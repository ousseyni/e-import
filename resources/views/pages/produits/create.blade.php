@extends('layouts.app', ['page_name' => 'Liste des Produits',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Gestion des Produits'])

@section('content')

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Nouveau produit</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif

                            <form method="post" action="{{ route('produits.store') }}">
                                @csrf
                                <div class="form-group row input-group-sm mb-2">
                                    <label for="code" class="col-sm-2 col-form-label col-form-label-sm">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="code" class="form-control form-control-sm" id="code" placeholder="Code">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-2">
                                    <label for="libelle" class="col-sm-2 col-form-label col-form-label-sm">Libellé</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="libelle" class="form-control form-control-sm" id="libelle" placeholder="Libellé">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-2">
                                    <label for="categorie_produit_id" class="col-sm-2 col-form-label col-form-label-sm">Catégorie</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" required="" id="categorie_produit_id" name="categorie_produit_id">
                                            <option value="">-- Sélectionnez une catégorie --</option>
                                            <optgroup label="Catégorie des AMC">
                                                @foreach($categoriesAmc as $categorie)
                                                    <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Catégorie des AMM">
                                                @foreach($categoriesAmm as $categorie)
                                                    <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-2">
                                    <label for="montant" class="col-sm-2 col-form-label col-form-label-sm">Montant</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="montant" class="form-control form-control-sm" id="montant" placeholder="Montant">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </form>

                        </div>
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

        $('body').on('change', '#categorieid', function () {

            const categorie_select = $("#categorieid :selected").val();
            console.log(categorie_select);

            $.ajax({
                type:"POST",
                url: "{{ url('produits/info') }}",
                data: { categorieid: categorie_select },
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    $('#montant').val(res.montant);
                }
            });
        });

    });

</script>
