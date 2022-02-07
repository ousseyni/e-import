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

                    <form>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <input type="email" class="form-control" id="hEmail" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <input type="password" class="form-control" id="hPassword" placeholder="">
                            </div>
                        </div>
                        <fieldset class="form-group mb-4">
                            <div class="row">
                                <label class="col-form-label col-xl-2 col-sm-3 col-sm-2 pt-0">Choose Segements</label>
                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                    <div class="form-check mb-2">
                                        <div class="custom-control custom-radio classic-radio-info">
                                            <input type="radio" id="hRadio1" name="classicRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="hRadio1">Segements 1</label>
                                        </div>
                                    </div>
                                    <div class="form-check mb-2">
                                        <div class="custom-control custom-radio classic-radio-info">
                                            <input type="radio" id="hRadio2" name="classicRadio" class="custom-control-input">
                                            <label class="custom-control-label" for="hRadio2">Segements 2</label>
                                        </div>
                                    </div>
                                    <div class="form-check disabled">
                                        <div class="custom-control custom-radio classic-radio-default">
                                            <input type="radio" id="hRadio3" name="classicRadio" class="custom-control-input" disabled>
                                            <label class="custom-control-label" for="hRadio3">Segements 3   ( disabled )</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group row">
                            <div class="col-sm-2">Apply</div>
                            <div class="col-sm-10">
                                <div class="form-check pl-0">

                                    <div class="custom-control custom-checkbox checkbox-info">
                                        <input type="checkbox" class="custom-control-input" id="hChkbox">
                                        <label class="custom-control-label" for="hChkbox">Terms Conditions</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary mt-3">Lets Go</button>
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
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/authentication/form-1.js')}}"></script></body>
</html>



{{-- @endsection --}}
