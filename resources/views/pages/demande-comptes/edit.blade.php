@extends('layouts.app', ['page_name' => "Comptes en attente d'activation",
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Gestion des contribuables'])

@section('content')

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Valdiation de la demande de création de compte</h4>
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

                            <form method="post" action="{{ route('demande-comptes.update', $demande->slug) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-row mb-4">
                                    <div class="col-6 input-group-sm">
                                        <label for="nif">NIF</label>
                                        <input readonly="" type="text" name="nif" id="nif" class="form-control" value="{{ $demande->nif }}" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="typecontribuableid">Type de contribution</label>
                                        <select class="form-control" id="typecontribuableid " name="typecontribuableid">
                                            @foreach($typeContribuables as $type)
                                                <option value="{{$type->id}}" {{ ($type->id === $demande->typecontribuableid ? 'selected' : '') }}>{{$type->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="col-12" id="msg" style="font-size: 10px"></span>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-12 input-group-sm">
                                        <label for="raisonsociale">Dénomination sociale</label>
                                        <input required="" type="text" id="raisonsociale" value="{{ $demande->raisonsociale }}" name="raisonsociale" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-7 input-group-sm">
                                        <label for="siegesocial">Siège sociale</label>
                                        <input required="" type="text" class="form-control" id="siegesocial" value="{{ $demande->siegesocial }}" name="siegesocial" />
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <label for="bp">B.P.</label>
                                        <input type="text" class="form-control" id="bp" name="bp" value="{{ $demande->bp }}" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="tel">Tél.</label>
                                        <input required="" type="text" class="form-control" id="tel" name="tel" value="{{ $demande->tel }}" />
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-4 input-group-sm">
                                        <label for="rccm">N° RCCM</label>
                                        <input required="" type="text" class="form-control" id="rccm" name="rccm" value="{{ $demande->rccm }}" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="numagrement">N° Agrément</label>
                                        <input type="text" class="form-control" id="numagrement" name="numagrement" value="{{ $demande->numagrement }}" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="numcartecomm">N° Carte Com.</label>
                                        <input type="text" class="form-control" id="numcartecomm" name="numcartecomm" value="{{ $demande->numcartecomm }}" />
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-8 input-group-sm">
                                        <label for="nomprenom">Nom et Prénom Représentant Légal</label>
                                        <input required="" type="text" class="form-control" id="nomprenom" name="nomprenom" value="{{ $demande->nomprenom }}"  />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="email">Email</label>
                                        <input required="" type="email" class="form-control" id="email" name="email" value="{{ $demande->email }}" />
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Valider et Créetr le compte</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
