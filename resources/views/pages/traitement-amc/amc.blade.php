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
            font-size: 18px;
        }

        .num_amm {
            position: absolute;
            letter-spacing: 0.5px;
            font-family: "Courier New", Courier, monospace;
            color: red;
            top: 230px;
            right: 235px;
            font-size: 16px;
        }
        .qrcode {
            position: absolute;
            bottom: 100px;
            left: 120px;
        }

        .cont1 {
            position: absolute;
            top: 333px;
            left: 210px;
        }

        .cont2 {
            position: absolute;
            top: 364px;
            left: 180px;
        }

        .cont3 {
            position: absolute;
            top: 364px;
            right: 200px;
        }

        .cont4 {
            position: absolute;
            top: 395px;
            left: 210px;
        }

        .cont5 {
            position: absolute;
            top: 395px;
            right: 200px;
        }

        .cont6 {
            position: absolute;
            top: 428px;
            left: 150px;
        }

        .cont7 {
            position: absolute;
            top: 428px;
            right: 280px;
        }

        .date_sign {
            position: absolute;
            top: 668px;
            right: 100px;
            font-size: 16px;
        }

        .sign1 {
            /* Chef */
            position: absolute;
            top: 175px;
            left: 300px;
            width: 65px;
        }

        .sign2 {
            position: absolute;
            top: 135px;
            left: 300px;
            width: 65px;
        }

        .sign3 {
            position: absolute;
            bottom: 150px;
            left: 520px;
            width: 175px;
        }

    </style>
</head>
<body>

<img src="data:image/jpg;base64,{{ $image }}" alt="amm" style="width: 99.9%;">
<img class="qrcode" src="data:image/jpg;base64,{{ $qrcode }}">

<div class="num_amm">{{ $amc->getNumDemande() }}</div>

<div class="cont1">{{ $amc->getContribuable->raisonsociale }}</div>
<div class="cont2">{{ (is_null($amc->getContribuable->typecontribuableid) ? '' : $amc->getContribuable->getTypeContribuables->libelle) }}</div>
<div class="cont3">{{ $amc->getContribuable->siegesocial }}</div>
<div class="cont4">{{ $amc->getContribuable->nif }}</div>
<div class="cont5">{{ $amc->getContribuable->rccm }}</div>
<div class="cont6">{{ $amc->getContribuable->bp }}</div>
<div class="cont7">{{ $amc->getContribuable->tel }}</div>


<div class="date_sign">{{ date_format(new DateTime($suivi->created_at), 'd/m/Y') }}</div>



</body>

</html>
