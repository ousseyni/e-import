<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ANNEXE DE L'AMM N° {{ $amm->getNumDemande() }} </title>

        <style>

            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0px;
                font-size: 12px;
                font-family: Helvetica, Arial, sans-serif;
                font-weight: bold;
            }

            .num_amm {
                position: absolute;
                letter-spacing: 2px;
                font-family: "Courier New", Courier, monospace;
                color: red;
                top: 217px;
                right: 165px;
            }

            .cont1 {
                position: absolute;
                top: 315px;
                left: 70px;
                font-size: 12px;
                font-family: Helvetica, Arial, sans-serif;
                font-weight: bold;
            }

            .cont2 {
                position: absolute;
                top: 349px;
                left: 70px;
            }

            .cont3 {
                position: absolute;
                top: 332px;
                left: 240px;
            }

            .cont4 {
                position: absolute;
                top: 349px;
                left: 245px;
            }

            .cont5 {
                position: absolute;
                top: 382px;
                left: 70px;
            }

            .cont6 {
                position: absolute;
                top: 382px;
                left: 225px;
            }

            .date_sign {
                position: absolute;
                bottom: 340px;
                right: 135px;
            }

            .sign1 {
                position: absolute;
                bottom: 160px;
                left: 100px;
                width: 120px;
            }

            .sign2 {
                position: absolute;
                bottom: 160px;
                left: 480px;
                width: 120px;
            }

            .sign3 {
                position: absolute;
                bottom: 160px;
                left: 850px;
                width: 175px;
            }

        </style>
    </head>
    <body>

        <img src="data:image/jpg;base64,{{ $image }}" alt="amm" style="width:100%;">

        <div class="num_amm">{{$amm->getNumDemande()}}</div>

        <div class="cont1">{{ $amm->getContribuable->raisonsociale }}</div>
        <div class="cont2">{{ $amm->getContribuable->siegesocial }}</div>
        <div class="cont3">{{ $amm->getContribuable->tel }}</div>
        <div class="cont4">{{ $amm->getContribuable->email }}</div>
        <div class="cont5">{{ $amm->getContribuable->nif }}</div>
        <div class="cont6">{{ $amm->getContribuable->rccm }}</div>

        <img class="sign1" src="data:image/jpg;base64,{{ $chef }}">
        <img class="sign2" src="data:image/jpg;base64,{{ $dir }}">
        <img class="sign3" src="data:image/jpg;base64,{{ $dg }}">

        <div class="date_sign">{{ date_format(new DateTime($suivi->created_at), 'd/m/Y') }}</div>

        <div class="mentions">
            <ul>
                @foreach($prescriptions as $prescription)
                    <li></li>
                @endforeach
            </ul>

        </div>

    </body>

</html>
