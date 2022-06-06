@extends('layouts.app', ['page_name' => 'Prescriptions particulières',
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
                        <a href="{{ route('prescriptions.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouvelle prescription</a>
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th width="3%">Code</th>
                                <th>Libelle</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $prescription->code }}</td>
                                    <td>{{ $prescription->libelle }}</td>
                                    <td>
                                        <a href="{{ route('prescriptions.edit', $prescription->id) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form id="form_del_{{ $loop->index }}" action="{{ route('prescriptions.destroy', $prescription->id) }}" method="post">
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
