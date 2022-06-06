@extends('layouts.app', ['page_name' => 'Profils',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Administration'])

@section('content')

    <div class="row layout-top-spacing">

        <div class="col-lg-12 col-12  layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Habilitations du profil : {{ $profil->libelle }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <table class="table">
                        <tr>
                            <th>Droits d'accès</th>
                        </tr>
                        @foreach($droits as $droit)
                            @if(in_array($droit->id, $tab_habilitaion))
                            <tr>
                                <td>{{ $droit->categorie }} > {{ $droit->libelle }}</td>
                            </tr>
                            @endif
                        @endforeach
                    </table>

                </div>
            </div>
        </div>

    </div>

@endsection
