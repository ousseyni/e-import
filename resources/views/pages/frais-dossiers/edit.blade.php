@extends('layouts.app', ['page_name' => 'Devises étrangères',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Parametrage'])

@section('content')

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Modification de frais de dossiers</h4>
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

                            <form method="post" action="{{ route('frais-dossiers.update', $frais->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="code" class="col-sm-2 col-form-label col-form-label-sm">Désignation</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $frais->designation }}" type="text" name="designation" class="form-control form-control-sm" id="designation" placeholder="Désignation">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="valeur_int" class="col-sm-2 col-form-label col-form-label-sm">Libellé</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $frais->valeur_int }}" type="text" name="valeur_int" class="form-control form-control-sm" id="valeur_int" placeholder="Montant">
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
