@extends('layouts.app', ['page_name' => 'Categorie de produits',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Gestion des produits'])

@section('content')

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Modification catégorie de produit</h4>
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

                            <form method="post" action="{{ route('categorie-produits.update', $categorieproduits->slug) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="code" class="col-sm-2 col-form-label col-form-label-sm">Code</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $categorieproduits->code }}" type="text" name="code" class="form-control form-control-sm" id="code" placeholder="Code">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="libelle" class="col-sm-2 col-form-label col-form-label-sm">Libellé</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $categorieproduits->libelle }}" type="text" name="libelle" class="form-control form-control-sm" id="libelle" placeholder="Libellé">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="montant" class="col-sm-2 col-form-label col-form-label-sm">Montant</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $categorieproduits->montant }}" type="text" name="montant" class="form-control form-control-sm" id="montant" placeholder="montant">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
