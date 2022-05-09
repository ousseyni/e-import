@extends('layouts.app', ['page_name' => 'Mes demandes',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.C.'])

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

                    <div class="table-responsive mb-4 mt-4">
                        <a href="{{ route('amc.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouvelle demande</a>
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>N° demande</th>
                                <th>Date demande</th>
                                <th>Provenance</th>
                                <th>Mode Transport</th>
                                <th>Date débarquement</th>
                                <th>Frais à payer</th>
                                <th>Statut</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($amcs as $amc)
                                <tr>
                                    <td>{{ $amc->getNumDemande() }}</td>
                                    <td>{{ $amc->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $amc->paysprov }}</td>
                                    <td>{{ $amc->modetransport }}</td>
                                    <td>{{ date_format(new DateTime($amc->datedebarque), 'd/m/Y') }}</td>
                                    <td>{{ number_format($amc->totalglobal, 0, '.', ' ') }}</td>
                                    <td><span class="badge badge-success" style="font-size: smaller">{{$amc->getEtat->libelle_user}}</span></td>
                                    <td>
                                        <a href="{{ route('amc.show', $amc->slug) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if($amc->etat == 1 or $amc->etat == 998)
                                            <a href="{{ route('amc.edit', $amc->slug) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($amc->etat == 1 or $amc->etat == 998)
                                            <form id="form_del_{{ $loop->index }}" action="{{ route('amc.destroy', $amc->slug) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" onclick="submit_form('form_del_{{ $loop->index }}')"><i class="far fa-trash-alt"></i></a>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
