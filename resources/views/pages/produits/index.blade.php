@extends('layouts.app', ['page_name' => 'Liste des Produits',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Gestion des Produits'])

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
                        <a href="{{ route('produits.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouveau produit</a>
                        <table id="contribuable" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Libelle</th>
                                <th>Montant</th>
                                <th>Categorie</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($produits as $produit)
                                <tr>
                                    <td>{{ $produit->code }}</td>
                                    <td>{{ $produit->libelle }}</td>
                                    <td>{{ number_format($produit->montant, 0, '.', ' ') }}</td>
                                    <td>{{ $produit->getCategorie == null ? '' : $produit->getCategorie->libelle}}</td>
                                    <td>
                                        <a href="{{ route('produits.edit', $produit->slug) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form onclick="return confirm('Voulez vous supprimer cette ligne ?')" action="{{ route('produits.destroy', $produit->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $produits->links() }}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
