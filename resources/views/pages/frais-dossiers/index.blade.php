@extends('layouts.app', ['page_name' => 'Frais de dossiers',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Parametrage'])

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
                        <a href="{{ route('frais-dossiers.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouveau frais de dossiers</a>
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th width="20%">Libelle</th>
                                <th>Montant (F CFA)</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($frais as $frai)
                                <tr>
                                    <td>{{ $frai->designation }}</td>
                                    <td>{{ number_format($frai->valeur_int, 0, '.', ' ') }}</td>
                                    <td>
                                        <a href="{{ route('frais-dossiers.edit', $frai->id) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form id="form_del_{{ $loop->index }}" action="{{ route('frais-dossiers.destroy', $frai->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="submit_form('form_del_{{ $loop->index }}')"><i class="far fa-trash-alt"></i></a>
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
