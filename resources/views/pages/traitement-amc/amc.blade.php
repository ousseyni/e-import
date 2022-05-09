<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AMC N° {{ $amc->getNumDemande() }} </title>

    <style>

        /**
            Set the margins of the page to 0, so the footer and the header
            can be of the full height and width !
         **/
        @page {
            margin: 0px;
            font-family: "Courier New", Courier, monospace;
            font-weight: bold;
            font-size: 20px;
        }

        .num_amm {
            position: absolute;
            letter-spacing: 2px;
            font-family: "Courier New", Courier, monospace;
            color: red;
            top: 243px;
            right: 200px;
        }

        .qrcode {
            position: absolute;
            top: 100px;
            left: 120px;
        }

        .cont1 {
            position: absolute;
            top: 318px;
            left: 210px;
        }

        .cont2 {
            position: absolute;
            top: 352px;
            left: 180px;
        }

        .cont3 {
            position: absolute;
            top: 352px;
            right: 170px;
        }

        .cont4 {
            position: absolute;
            top: 386px;
            left: 185px;
        }

        .cont5 {
            position: absolute;
            top: 386px;
            right: 200px;
        }

        .mentions {
            position: absolute;
            top: 775px;
            left: 50px;
            font-size: 9px;
        }

        .agent {
            position: absolute;
            top: 775px;
            left: 275px;
            font-size: 9px;
        }

        .date_sign {
            position: absolute;
            top: 694px;
            right: 100px;
            font-size: 16px;
        }

        .sign1 {
            position: absolute;
            bottom: 155px;
            left: 70px;
            width: 120px;
        }

        .sign2 {
            position: absolute;
            bottom: 155px;
            left: 300px;
            width: 120px;
        }

        .sign3 {
            position: absolute;
            bottom: 155px;
            left: 520px;
            width: 175px;
        }

    </style>
</head>
<body>

<img src="data:image/jpg;base64,{{ $image }}" alt="amm" style="width: 99.9%;">
<img class="qrcode" src="data:image/jpg;base64,{{ $qrcode }}">

<div class="num_amm">{{$amc->getNumDemande()}}</div>

<div class="cont1">{{ $amc->getContribuable->raisonsociale }}</div>
<div class="cont2">{{ (is_null($amc->getContribuable->typecontribuableid) ? '' : $amc->getContribuable->getTypeContribuables->libelle) }}</div>
<div class="cont3">{{ $amc->getContribuable->nif }}</div>
<div class="cont4">{{ $amc->getContribuable->siegesocial }}</div>
<div class="cont5">{{ $amc->getContribuable->rccm }}</div>

<div class="mentions">
    <ul>
        @foreach($prescriptions as $prescription)
            <li>{{ $prescription->getPrescription->libelle  }}</li>
        @endforeach
    </ul>
    <br><br>
    <div style="margin-left: 30px; word-wrap: break-word; width: 150px">{{ $prescriptions[0]->comments }}</div>ù
</div>

<div class="agent">
    Vu le : {{ date_format(new DateTime($prescriptions[0]->dateprpt), 'd/m/Y')  }} <br>
    <img src="data:image/jpg;base64,{{ $agent }}" width="120">
</div>

<img class="sign1" src="data:image/jpg;base64,{{ $chef }}">
<img class="sign2" src="data:image/jpg;base64,{{ $dir }}">
<img class="sign3" src="data:image/jpg;base64,{{ $dg }}">

<div class="date_sign">{{ date_format(new DateTime($suivi->created_at), 'd/m/Y') }}</div>



</body>

</html>
