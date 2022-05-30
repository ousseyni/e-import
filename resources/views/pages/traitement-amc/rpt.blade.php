<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RAPPORT D'INSPECTION DE L'AMC N° {{ $amc->getNumDemande() }} </title>

        <style>

            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0px;
                font-size: 12px;
                font-family: Helvetica, Arial, sans-serif;
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 15px;
                padding-top: 5px;
                text-align: center;
                width: 100%;
                border-top: 0.1px solid black;
                font-size: 10px;
            }

            .num_amm {
                position: absolute;
                letter-spacing: 0px;
                font-family: "Courier New", Courier, monospace;
                color: red;
                top: 239px;
                right: 215px;
                font-weight: bold;
                font-size: 14px;
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
                font-weight: bold;
            }

            .cont3 {
                position: absolute;
                top: 332px;
                left: 225px;
                font-weight: bold;
            }

            .cont4 {
                position: absolute;
                top: 349px;
                left: 225px;
                font-weight: bold;
            }

            .cont5 {
                position: absolute;
                top: 366px;
                left: 270px;
                font-weight: bold;
            }

            .cont6 {
                position: absolute;
                top: 382px;
                left: 270px;
                font-weight: bold;
            }

            .cont7 {
                position: absolute;
                top: 382px;
                left: 70px;
                font-weight: bold;
            }

            .sign1 {
                /* Chef */
                position: absolute;
                top: 170px;
                left: 300px;
                width: 65px;
            }

            .sign2 {
                position: absolute;
                top: 130px;
                left: 300px;
                width: 65px;
            }

            .sign3 {
                position: absolute;
                bottom: 50px;
                left: 630px;
            }

            .agent {
                position: absolute;
                top: 280px;
                right: 50px;
            }

            .table {
                width: 692px;
                margin-left: 57px;
                left: 200px;
                right: 50px;
            }

            #watermark {
                position: fixed;
                bottom:   8cm;
                left:     5.5cm;
                width:    8cm;
                height:   8cm;
                z-index:  -1000;
            }

            .qrcode {
                position: absolute;
                top: 280px;
                right: 250px;
            }
        </style>
    </head>
    <body>

        <img src="data:image/jpg;base64,{{ $image }}" alt="amm" style="width:100%;">

        <div class="num_amm">{{$amc->getNumDemande()}}</div>

        <div class="cont1">{{ $amc->getContribuable->raisonsociale }}</div>
        <div class="cont2">{{ $amc->getContribuable->siegesocial }}</div>
        <div class="cont3">{{ $amc->getContribuable->tel }}</div>
        <div class="cont4">{{ $amc->getContribuable->email }}</div>
        <div class="cont5">{{ $amc->getContribuable->nif }}</div>
        <div class="cont6">{{ $amc->getContribuable->rccm }}</div>
        <div class="cont7">{{ $amc->getContribuable->bp }}</div>

        <div class="agent">
            Effectué le : {{ date_format(new DateTime($inspection->dateinspection), 'd/m/Y')  }}
            <br>
            par {{ $user->name  }} <br><br>
            <img src="data:image/jpg;base64,{{ $agent }}" width="120">
        </div>

        <div class="table">
            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th colspan="4"> Informations de voyage</th>
                </tr>
                <tr>
                    <td colspan="2">
                        Pays de provenance : <b>{{ $inspection->paysprov }}</b>
                    </td>
                    <td colspan="2">
                        Mode de transport : <b>{{ $inspection->modetransport }}</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Conditions de transport : <b>{{ $inspection->conditiontransport }}</b>
                    </td>
                    <td>
                        Point d'entrée : <b>{{ $inspection->poinentree }}</b>
                    </td>
                    <td colspan="2">
                        Lieu de l'inspection : <b>{{ $inspection->lieuinspection }}</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nature des produits inspectés  : <b>{{ $inspection->natureproduits }}</b>
                    </td>
                    <td colspan="2">
                        Commentaires : <b>{{ $inspection->comment_transport }}</b>
                    </td>
                    <td>
                        Quantité totale : <br><b> {{ number_format($inspection->totalqte, 0, '.', ' ') }} Kg</b>
                    </td>
                </tr>
            </table>
        </div>

        <br><br>

        <div id="watermark">
            <img src="data:image/jpg;base64,{{ $filigrane }}" height="400" width="400" />
        </div>
        <img class="qrcode" src="data:image/jpg;base64,{{ $qrcode }}">

        <div class="table">
            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th colspan="2"> Informations sur les conteneurs inspectés</th>
                </tr>
                @foreach($lignes_inspections_conteneurs as $conteneur)
                    <tr>
                        <td>
                            Conteneur N° {{ 1 + $loop->index  }} :<br> <b>{{ $conteneur->conteneurinspecte }}</b>
                        </td>
                        <td>
                            Numéro de plomb :<br> <b>{{ $conteneur->numeroplomb }}</b>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <br>
        <div class="table">
            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th colspan="4"> Informations sur les produits inspectés</th>
                </tr>
                @foreach($lignes_inspections_produits as $produit)
                    <tr>
                        <td>
                            Produit {{ 1 + $loop->index  }} :<br> <b>{{ $produit->nom }}</b>
                        </td>
                        <td>
                            Marque :<br> <b>{{ $produit->marque }}</b>
                        </td>
                        <td>
                            N° Lot :<br> <b>{{ $produit->numerolot }}</b>
                        </td>
                        <td>
                            Pays d’origine :<br> <b>{{ $produit->paysorig }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Fournisseur :<br> <b>{{ $produit->fournisseur }}</b>
                        </td>
                        <td>
                            Ingrédient :<br> <b>{{ $produit->ingredients }}</b>
                        </td>
                        <td>
                            Poids/Volume :<br> <b>{{ number_format($produit->qtenet, 0, '.', ' ') }}Kg</b>
                        </td>
                        <td>
                            DLC/DLUO :<br> <b>{{ date_format(new DateTime($produit->durabilite), 'd/m/Y') }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mode emploi :<br> <b>{{ $produit->modeemploi }}</b>
                        </td>
                        <td>
                            Allégation :<br> <b>{{ $produit->allegation }}</b>
                        </td>
                        <td>
                            Avec emballage secondaire ? <br> <b>{{ $produit->fournisseur }}</b>
                        </td>
                        <td>
                            Emballage secondaire intacte ? <br> <b>{{ $produit->fournisseur }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="150px">
                            Avec emballage primaire ? <br> <b>{{ $produit->fournisseur }}</b>
                        </td>
                        <td width="150px">
                            Emballage secondaire primaire ? <br> <b>{{ $produit->fournisseur }}</b>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <br>
        <div class="table">
            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th> Conclusion finale </th>
                </tr>
                <tr>
                    <td>
                        @if($inspection->conclusion == 1)
                            <strong style="color: green">Le(s) produit(s) inspecté(s) est(sont) conforme(s)</strong>
                        @else
                            <strong style="color: red">Le(s) produit(s) inspecté(s) n'est(ne sont) pas conforme(s)</strong>
                        @endif
                    </td>
                </tr>
                @if($inspection->conclusion == 0)
                    <tr>
                        <td>
                            Observations : <br>
                            {{ $inspection->observation }}
                        </td>
                    </tr>
                @endif
            </table>
        </div>

        <footer>
            Direction Générale de la Concurrence et de la Consommation <br>
            Avenue Jean Félix EBOUE B.P : 1064 Libreville (Gabon) / Tél. : 011 79 50 14
        </footer>

    </body>

</html>
