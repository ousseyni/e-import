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
                top: 222px;
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

            .mentions {
                position: absolute;
                top: 285px;
                left: 460px;
                font-size: 12px;
                font-family: Helvetica, Arial, sans-serif;
                word-wrap: break-word;
                width: 220px;
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
                bottom: 50px;
                left: 120px;
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
        <div class="cont7">{{ $amm->getContribuable->bp }}</div>

        <div class="mentions">
            <ul>
                @foreach($prescriptions as $prescription)
                    <li>{{ $prescription->getPrescription->libelle  }}</li>
                @endforeach
            </ul>
            <br>
            <span>{{ $prescriptions[0]->comments }}</span>
        </div>

        <div class="agent">
            Traité le : {{ date_format(new DateTime($prescriptions[0]->dateprpt), 'd/m/Y')  }} <br>
            <img src="data:image/jpg;base64,{{ $agent }}" width="120">
        </div>

        <div class="table">
            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th colspan="4"> Informations de voyage</th>
                </tr>
                <tr>
                    <td colspan="2">
                        Pays de provenance : <b>{{ $amm->paysprov }}</b>
                    </td>
                    <td colspan="2">
                        Mode de transport : <b>{{ $amm->modetransport }}</b>
                    </td>
                </tr>
                @if($amm->modetransport == 'Aérien')
                    @foreach($infos_voyage as $infos)
                    <tr>
                        <td colspan="2">
                            N° LTA : <b>{{ $infos->numlta }}</b>
                        </td>
                        <td>
                            Compagnie aérienne : <b>{{ $infos->cieaerien }}</b>
                        </td>
                        <td>
                            N° Vol : <b>{{ $infos->numvol }}</b>
                        </td>
                    </tr>
                    @endforeach
                @elseif($amm->modetransport == 'Terrestre')
                    @foreach($infos_voyage as $infos)
                        <tr>
                            <td colspan="2">
                                N° LVI : <b>{{ $infos->numlvi }}</b>
                            </td>
                            <td>
                                N° Véhicule : <b>{{ $infos->numvehicule }}</b>
                            </td>
                            <td>
                                N° Conteneur : <b>{{ $infos->numconteneurt }}</b>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach($infos_voyage as $infos)
                        <tr>
                            <td>
                                Nom du navire : <b>{{ $infos->nomnavire }}</b> <br>
                                    N° voyage : <b>{{ $infos->numvoyage }}</b>
                            </td>
                            <td>
                                N° BIETC : <b>{{ $infos->numbietc }}</b>
                            </td>
                            <td>
                                N° Connaissement : <b>{{ $infos->numconnaissement }}</b>
                            </td>
                            <td>
                                N° Conteneur {{ 1 + $loop->index  }} : <b>{{ $infos->numconteneur }}</b>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td width="150px">
                        Date d'embarquement : <br><b>{{ date_format(new DateTime($amm->dateembarque), 'd/m/Y')  }} </b>
                    </td>
                    <td width="150px">
                        @if($amm->modetransport == 'Maritime')
                            Port
                        @else
                            Lieu
                        @endif
                        d’embarquement : <br><b>{{ $amm->lieuembarque }}</b>
                    </td>
                    <td width="150px">
                        Date de débarquement :<br><b>{{ date_format(new DateTime($amm->datedebarque), 'd/m/Y') }}</b>
                    </td>
                    <td width="150px">
                        @if($amm->modetransport == 'Maritime')
                            Port
                        @else
                            Lieu
                        @endif
                         de débarquement :<br><b>{{ $amm->lieudebarque }} </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        Poids net : <br><b> {{ number_format($amm->totalpoids, 0, '.', ' ') }} Kg</b>
                    </td>
                </tr>
            </table>
        </div>

        <br><br>

        <div id="watermark">
            <img src="data:image/jpg;base64,{{ $filigrane }}" height="400" width="400" />
        </div>

        <div class="table">
            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                <tr>
                    <th colspan="4"> Informations de produits</th>
                </tr>
                @foreach($produits_amm as $produit)
                    <tr>
                        <td width="150px">
                            Produit {{ 1 + $loop->index  }} :<br> <b>{{ $produit->getProduit->libelle }}</b>
                        </td>
                        <td width="150px">
                            Fournisseur :<br> <b>{{ $produit->fournisseur }}</b>
                        </td>
                        <td width="150px">
                            Pays d’origine :<br> <b>{{ $produit->paysorig }}</b>
                        </td>
                        <td width="70px">
                            Poids :<br> <b>{{ number_format($produit->poids, 0, '.', ' ') }}Kg</b>
                        </td>
                        <td width="100px">
                            Marque :<br> <b>{{ $produit->marque }}</b>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3"></td>
                    <td colspan="2">
                        Valeur CAF :<br><b> {{ number_format($amm->valeurcaf_cfa, 0, '.', ' ')  }} F CFA</b>
                    </td>
                </tr>
            </table>
        </div>

        <img class="sign1" src="data:image/jpg;base64,{{ $chef }}">
        <img class="sign2" src="data:image/jpg;base64,{{ $dir }}">

        <div class="sign3">
            Visa DGCC <br>
            <img src="data:image/jpg;base64,{{ $dg }}" style="width: 100px; height: 100px">
        </div>

        <footer>
            Direction Générale de la Concurrence et de la Consommation <br>
            Avenue Jean Félix EBOUE B.P : 1064 Libreville (Gabon) / Tél. : 011 79 50 14
        </footer>

    </body>

</html>
