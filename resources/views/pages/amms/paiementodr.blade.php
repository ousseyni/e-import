@extends('layouts.app', ['page_name' => 'Mes demandes',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.M.'])

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-8 col-lg-8 col-sm-8  layout-spacing">
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
                        <h5>Paiement de l'ordre de recette N° <b>{{ $odr->getNumOdr() }}</b>  </h5><br>
                        <strong>Relatif à l'A.M.M N° <b>{{ $amm->getNumDemande() }}</b>  </strong><br><br>
                        <div></div>
                            <form method="post" id="form-amm-amc" action="{{ route('amm.save_paiement', $amm) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="numero_quittance" class="col-sm-4 col-form-label col-form-label-sm">Numéro de la quittance</label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="numero_quittance" class="form-control form-control-sm" id="numero_quittance" placeholder="Numéro de la quitance de paiement">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="date_paye" class="col-sm-4 col-form-label col-form-label-sm">Date de la quittance</label>
                                    <div class="col-sm-8">
                                        <input type="date" required name="date_paye" class="form-control form-control-sm" id="date_paye">
                                    </div>
                                </div>
                                <div class="form-group row input-group-sm mb-4">
                                    <label for="pj_quittance" class="col-sm-4 col-form-label col-form-label-sm">Joindre la quittance</label>
                                    <input type="hidden" name="idamm" value="{{ $amm->id }}">
                                    <input type="hidden" name="idodr" value="{{ $odr->id }}">
                                    <div class="col-8 input-group-sm">
                                        <input type="file" id="pj_quittance" required="" accept=".pdf, .jpg, .png, .jpeg" id="pj2" name="pj_quittance" />
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
