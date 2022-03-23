@extends('layouts.app', ['page_name' => 'Mes demandes',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Demandes A.M.M.'])

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
                        <a href="{{ route('amm.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouvelle demande</a>
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>N° demande</th>
                                <th>Date demande</th>
                                <th>Provenance</th>
                                <th>Fournisseur</th>
                                <th>N° Conteneur</th>
                                <th>Montant Demande</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($amms as $amm)
                                <tr>
                                    <td>{{ $amm->getNumDemande() }}</td>
                                    <td>{{ $amm->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $amm->paysprov }}</td>
                                    <td>{{ $amm->fournisseur }}</td>
                                    <td>{{ $amm->numconteneur }}</td>
                                    <td>{{ number_format($amm->totalamm, 0, '.', ' ') }}</td>
                                    <td>
                                        <a href="{{ route('amm.show', $amm->slug) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('amm.edit', $amm->slug) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form onclick="return confirm('Voulez vous suppriemr cette demande ?')" action="{{ route('amm.destroy', $amm->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button>
                                        </form>
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
