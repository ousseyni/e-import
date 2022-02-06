@extends('layouts.app')

@section('content')
    <div class="card uper">
        <div class="card-header">
            Ajouter une catégorie de produit
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
                <form method="post" action="{{ route('categorie-produits.store') }}">
        <div class="form-group row mb-4">
            <label for="libelle" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Libelle</label>
            <div class="col-xl-10 col-lg-9 col-sm-10">
                <input type="text" name="libelle" class="form-control" id="libelle" placeholder="">
            </div>
        </div>
        <div class="form-group row mb-4">
            <label for="montant" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Montant</label>
            <div class="col-xl-10 col-lg-9 col-sm-10">
                <input type="number" name="montant" class="form-control" id="montant" placeholder="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
            </div>
        </div>
    </form>
@endsection
