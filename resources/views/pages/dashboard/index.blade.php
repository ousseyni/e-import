@extends('layouts.app', ['page_name' => 'Tableau de bord',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Accueil'])

@section('content')

    <div class="layout-px-spacing" >

        <h3>Bienvenue sur eService DGCC</h3>
        <div style="text-align: center">
            <img src="{{asset('storage/img/dgcc.png')}}" width="500" alt="">
        </div>


    </div>

@endsection
