@extends('layouts.app', ['page_name' => 'Utilisateurs',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Administration'])

@section('content')

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Modification catégorie de produit</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif

                                <form method="post" action="{{ route('users.update', $user->slug) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row input-group-sm mb-2">
                                        <label for="name" class="col-sm-2 col-form-label col-form-label-sm">Nom & prénom(s)</label>
                                        <div class="col-sm-10">
                                            <input type="text" required value="{{$user->name}}" name="name" class="form-control form-control-sm" id="name" placeholder="Nom et prénom(s)">
                                        </div>
                                    </div>
                                    <div class="form-group row input-group-sm mb-2">
                                        <label for="email" class="col-sm-2 col-form-label col-form-label-sm">Adresse électrique</label>
                                        <div class="col-sm-10">
                                            <input type="email" required value="{{$user->email}}" name="email" class="form-control form-control-sm" id="email" placeholder="Adresse email">
                                        </div>
                                    </div>
                                    <div class="form-group row input-group-sm mb-4">
                                        <label for="profilid" class="col-sm-2 col-form-label col-form-label-sm">Profil</label>
                                        <div class="col-sm-10">
                                            <select class="form-control form-control-sm" id="profilid" name="profilid">
                                                @foreach($profils as $profil)
                                                    <option {{ ($user->profilid == $profil->id ? 'selected' : '') }} value="{{$profil->id}}">{{$profil->libelle}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row input-group-sm mb-2">
                                        <label for="login" class="col-sm-2 col-form-label col-form-label-sm">Identifiant (Matricule)</label>
                                        <div class="col-sm-10">
                                            <input type="text" required value="{{$user->login}}" name="login" class="form-control form-control-sm" id="login" placeholder="Identifiant (Matricule)">
                                        </div>
                                    </div>
                                    <div class="form-group row input-group-sm mb-2">
                                        <label for="password" class="col-sm-2 col-form-label col-form-label-sm">Mot de passe</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Saisir pour changer le mot de passe (facultatif)">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
