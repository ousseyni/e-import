@extends('layouts.app', ['page_name' => "Comptes en attente d'activation",
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Gestion des contribuables'])

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
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>NIF</th>
                                <th>Raison Sociale</th>
                                <th>Type</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($demandecomptes as $contribuable)
                                <tr>
                                    <td>{{$contribuable->nif}}</td>
                                    <td>{{$contribuable->raisonsociale}}</td>
                                    <td>{{$contribuable->getTypeContribuables == null ? '' : $contribuable->getTypeContribuables->libelle}}</td>
                                    <td>{{$contribuable->tel}}</td>
                                    <td>{{$contribuable->email}}</td>
                                    <td>
                                        <a href="{{ route('demande-comptes.edit', $contribuable->slug)}}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form onclick="return confirm('Voulez vous suppriemr cette ligne ?')" action="{{ route('demande-comptes.destroy', $contribuable->slug)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $demandecomptes->links() }}
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
