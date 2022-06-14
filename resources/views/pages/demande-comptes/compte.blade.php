{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activation de compte utilisateur | e-services | Gestion des AMM & AMC</title>
    <link rel="icon" type="image/x-icon" href="{{asset('storage/img/favicon.ico')}}"/>
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

                    <h1 style="font-size: 30px">Activation de compte utilisateur <span class="brand-name">e-Services</span></h1>

                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if(session()->get('error'))
                        <div class="alert alert-error">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <form method="post" action="{{ url('demande-comptes/activate-compte', $user->email_verification_token) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-row mb-2">
                            <div class="col-12 input-group-sm">
                                <label for="login">Identifiant : </label>
                                <input id="login" placeholder="Identifiant" name="login" readonly="" type="text" value="{{$user->login}}" class="form-control" />
                            </div>
                        </div>
                        <hr/>
                        <div class="form-row mb-2">
                            <div class="col-6 input-group-sm">
                                <label for="password1">Mot de passe</label>
                                <input required="" type="password" id="password1" name="password1" class="form-control" />
                            </div>

                            <div class="col-6 input-group-sm">
                                <label for="password2">Repeter le mot de passe</label>
                                <input required="" type="password" id="password2" name="password2" class="form-control" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Valider</button>
                    </form>

                    <p class="terms-conditions">© 2022 Tous droits reservés. <a href="#">e-Services</a>  <a href="javascript:void(0);">DGCC</a>.</p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image"></div>
    </div>
</div>


<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/authentication/form-1.js')}}"></script></body>

{{-- Forms Input Mask --}}
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('plugins/input-mask/input-mask.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-chained/1.0.1/jquery.chained.min.js"></script>
<script>
    $(document).ready(function(){
        $("#sousactiviteid").chained("#activiteid");
    });
</script>


</html>



{{-- @endsection --}}
