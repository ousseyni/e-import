@extends('layouts.app', ['page_name' => 'Devises étrangères',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Parametrage'])

@section('content')

    <div class="container">

        <div class="container">

            <div class="row">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Nouvelle prescription</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content ">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif

                            <form method="post" action="{{ route('prescriptions.store') }}">
                                @csrf
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="code" class="col-sm-2 col-form-label col-form-label-sm">Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="code" class="form-control form-control-sm" id="code" placeholder="Code">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="libelle" class="col-sm-2 col-form-label col-form-label-sm">Libellé</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="libelle" class="form-control form-control-sm" id="libelle" placeholder="Libellé">
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
