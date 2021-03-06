{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}

    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Création de comptes contribuables | e-services | Gestion des AMM & AMC</title>
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

                    <h1 class="">Création d'un compte <span class="brand-name">e-Service</span></h1>
                    <p class="signup-link">Faites la demande de création de votre compte directement en ligne</p>

                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if(session()->get('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('demande-comptes.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row mb-2">
                            <div class="col-6 input-group-sm">
                                <label for="nif">NIF/N° Stat/Matricule</label>
                                <input type="text" required="" name="nif" id="nif" class="form-control" />
                            </div>
                            <div class="col-6 input-group-sm">
                                <label for="typecontribuableid">Type d'usagers</label>
                                <select class="form-control" id="typecontribuableid " name="typecontribuableid">
                                    @foreach($typeContribuables as $type)
                                        <option value="{{$type->id}}">{{$type->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="col-12" id="msg" style="font-size: 10px"></span>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-12 input-group-sm">
                                <label for="raisonsociale">Dénomination sociale</label>
                                <input required="" type="text" id="raisonsociale" name="raisonsociale" class="form-control" />
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-6 input-group-sm">
                                <label for="tel">Tél.</label>
                                <input required="" type="text" class="form-control" id="tel" name="tel" />
                            </div>
                            <div class="col-6 input-group-sm">
                                <label for="email">Email</label>
                                <input required="" type="email" class="form-control" id="email" name="email" />
                            </div>
                        </div>

                        <div class="form-row mb-4">
                            <div class="col-6 input-group-sm">
                                Joindre la fiche circuit
                            </div>
                            <div class="col-6 input-group-sm">
                                <input type="file" required="" accept=".pdf, .jpg, .png, .jpeg" name="pj" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Envoyez la demande</button>
                    </form>

                    <p class="signup-link text-right">Vous avez un compte? <a href="/connexion">Connexion</a></p>

                    <p class="terms-conditions">© 2022 Tous droits reservés. <a href="#">e-Services</a>  <a href="javascript:void(0);">DGCC</a>.</p>

                </div>
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/authentication/form-1.js')}}"></script></body>

{{-- Forms Input Mask --}}
<script src="{{asset('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('plugins/input-mask/input-mask.js')}}"></script>


</html>



{{-- @endsection --}}
<script>
    $(document).ready(function () {


        $('body').on('blur', '#nif', function () {

            var nif_val = $('#nif').val();
            console.log(nif_val);

            $.ajax({
                type:"POST",
                url: "{{ url('contribuables/user') }}",
                data: { nif: nif_val },
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    console.log('test');
                    if (res.nb === 0) {
                        $('#msg').html('Société non pré-enregistrée à la DGCC');
                        $('#raisonsociale').val('');
                        $('#tel').val('');
                        $('#email').val('');
                    }
                    else {
                        $('#msg').html('Société pré-enregistrée à la DGCC');
                        $('#raisonsociale').val(res.data.raisonsociale);
                        $('#tel').val(res.data.tel);
                        $('#email').val(res.data.email);
                    }

                }
            });
        });

    });

</script>

