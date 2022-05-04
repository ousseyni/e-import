<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>AMM N° {{ $amm->getNumDemande() }} </title>

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
                top: 158px;
                right: 370px;
            }

            .qrcode {
                position: absolute;
                top: 90px;
                left: 120px;
            }

            .cont1 {
                position: absolute;
                top: 230px;
                left: 210px;
            }

            .cont2 {
                position: absolute;
                top: 230px;
                left: 800px;

            }

            .cont3 {
                position: absolute;
                top: 269px;
                left: 250px;
            }

            .cont4 {
                position: absolute;
                top: 269px;
                left: 600px;
            }

            .date_sign {
                position: absolute;
                bottom: 317px;
                right: 135px;
                font-size: 16px;
            }

            .sign1 {
                position: absolute;
                bottom: 150px;
                left: 100px;
                width: 120px;
            }

            .sign2 {
                position: absolute;
                bottom: 150px;
                left: 480px;
                width: 120px;
            }

            .sign3 {
                position: absolute;
                bottom: 130px;
                left: 850px;
                width: 175px;
            }

        </style>
    </head>
    <body>

        <img src="data:image/jpg;base64,{{ $image }}" alt="amm" style="width:100%;">
        <img class="qrcode" src="data:image/jpg;base64,{{ $qrcode }}">

        <div class="num_amm">{{$amm->getNumDemande()}}</div>

        <div class="cont1">{{ $amm->getContribuable->raisonsociale }}</div>
        <div class="cont2">{{ $amm->getContribuable->getTypeContribuables->libelle }}</div>
        <div class="cont3">{{ $amm->getContribuable->nif }}</div>
        <div class="cont4">{{ $amm->getContribuable->siegesocial }}</div>

        <img class="sign1" src="data:image/jpg;base64,{{ $chef }}">
        <img class="sign2" src="data:image/jpg;base64,{{ $dir }}">
        <img class="sign3" src="data:image/jpg;base64,{{ $dg }}">

        <div class="date_sign">{{ date_format(new DateTime($suivi->created_at), 'd/m/Y') }}</div>



    </body>

</html>
