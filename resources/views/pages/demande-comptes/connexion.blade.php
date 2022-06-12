{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion des usagers | e-services DGCC</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="icon" type="image/x-icon" href="{{asset('storage/img/favicon.ico')}}"/>
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

                    <h1 class="" style="font-size: 34px"> <a href="#"><span class="brand-name">DEMANDE AMM/AMC</span></a></h1>
                    <p class="signup-link">Vous n'avez pas de compte ? <a href="/demande-comptes">Créer un compte</a></p>

                    @if(session()->get('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div><br />
                    @endif

                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="text-left">
                        @csrf
                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="login" type="text" placeholder="Identifiant" class="form-control @error('login') is-invalid @enderror" name="login" required="" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror</div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" placeholder="Mot de passe" class="form-control @error('password') is-invalid @enderror" required="">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper toggle-pass">
                                    <p class="d-inline-block">Afficher mot de passe</p>
                                    <label class="switch s-primary">
                                        <input type="checkbox" id="toggle-password" class="d-none">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">Connexion</button>
                                </div>
                            </div>

                            <div class="field-wrapper">
                                <a href="#" class="forgot-pass-link">Mot de passe oublié ?</a>
                            </div>

                        </div>
                    </form>

                    <p class="terms-conditions">© 2022 Tous droits reservés. <a href="#">e-Services</a>  <a href="javascript:void(0);">DGCC</a>.</p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-images">
        </div>
    </div>
</div>


<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/authentication/form-1.js')}}"></script></body>
</html>



{{-- @endsection --}}
