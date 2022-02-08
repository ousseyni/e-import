{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Création de compte</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    {{-- Forms Input Mask --}}
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
    <style>
        .form-form .form-form-wrap form .field-wrapper svg.feather-eye {
            top: 46px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class=""> <a href="#"><span class="brand-name">e-Services</span></a></h1>
                    <p class="signup-link">Remplissez le formulaire pour créer votre compte</p>

                    <form method="post" action="{{ route('demande-comptes.store') }}">
                        <div class="form-group row input-group-sm mb-4">
                            <label for="nif" class="col-sm-2 col-form-label col-form-label-sm">N.I.F.</label>
                            <div class="col-sm-10">
                                <input type="text" id="nif" name="nif" class="form-control form-control-sm" id="nif" placeholder="NIF">
                            </div>
                        </div>

                        <div class="form-group row input-group-sm mb-4">
                            <label for="nom" class="col-sm-2 col-form-label col-form-label-sm">Noms et prénoms</label>
                            <div class="col-sm-10">
                                <input type="text" id="nom" name="nom" class="form-control form-control-sm" id="nom" placeholder="Noms et prénoms">
                            </div>
                        </div>

                        <div class="form-group row input-group-sm mb-4">
                            <label for="tel" class="col-sm-2 col-form-label col-form-label-sm">Numéro de téléphone</label>
                            <div class="col-sm-10">
                                <input type="text" id="tel" name="tel" class="form-control form-control-sm" id="tel" placeholder="Votre numéro">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="email" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <input type="email" class="form-control" id="email" placeholder="">
                            </div>
                        </div>
                        <div class="custom-file mb-4">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choisir un fichier</label>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
                            </div>
                        </div>
                    </form>

                    <p class="terms-conditions">© 2022 Tous droits reservé. <a href="#">e-Services</a>  <a href="javascript:void(0);">DGCC</a>.</p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>


<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/authentication/form-1.js')}}"></script></body>

{{-- Forms Input Mask --}}
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('plugins/input-mask/input-mask.js')}}"></script>


</html>



{{-- @endsection --}}
