@extends('layouts.app', ['page_name' => "Validation des demandes",
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Traitement des A.M.C.'])

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">

                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                    @endif
                    <h4><u>Demandes en cours de validation</u></h4>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>N°</th>
                                <th>Date demande</th>
                                <th>Usager</th>
                                <th>Provenance</th>
                                <th>Mode Transp.</th>
                                <th>Date débarq.</th>
                                <th>Frais</th>
                                <th>Trace</th>
                                <th>ODR</th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($demandes_etudes as $amc)
                                <tr>
                                    <td>{{ $amc->getNumDemande() }}</td>
                                    <td>{{ $amc->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $amc->getContribuable->nif.' - '.$amc->getContribuable->raisonsociale}}</td>
                                    <td>{{ $amc->paysprov }}</td>
                                    <td>{{ $amc->modetransport }}</td>
                                    <td>{{ date_format(new DateTime($amc->datedebarque), 'd/m/Y') }}</td>
                                    <td>{{ number_format($amc->totalglobal, 0, '.', ' ') }}</td>
                                    <td>
                                        <a href="{{ route('traitement-amc.trace', $amc->slug) }}">
                                            {{ $amc->getEtat->libelle_dgcc }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($amc->haveOrdreRecette())
                                            <a target="_blank" href="{{ route('traitement-amc.dwlord', $amc->slug) }}">
                                                <i class="far fa-file"></i>
                                            </a>
                                        @else
                                            N/D
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('traitement-amc.traitement', $amc->slug) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $demandes_etudes->links() }}
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection


