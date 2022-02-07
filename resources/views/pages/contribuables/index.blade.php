@extends('layouts.app', ['page_name' => 'Liste des contribuables',
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
                        <a href="{{ route('contribuables.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouveau compte contribuable</a>
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>NIF</th>
                                <th>Raison Sociale</th>
                                <th>Type</th>
                                <th>RCCM</th>
                                <th>BP</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contribuables as $contribuable)
                                <tr>
                                    <td>{{$contribuable->nif}}</td>
                                    <td>{{$contribuable->raisonsocial}}</td>
                                    <td>{{$contribuable->getTypeContribuables->libelle}}</td>
                                    <td>{{$contribuable->rccm}}</td>
                                    <td>{{$contribuable->bp}}</td>
                                    <td>{{$contribuable->tel}}</td>
                                    <td>{{$contribuable->email}}</td>
                                    <td>
                                        <a href="{{ route('contribuables.edit', $contribuable->slug)}}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form onclick="return confirm('Voulez vous suppriemr cette ligne ?')" action="{{ route('contribuables.destroy', $contribuable->slug)}}" method="post">
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
