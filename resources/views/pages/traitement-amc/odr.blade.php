<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ordre de recette de l'AMC N° {{ $amc->getNumDemande() }} </title>



        <style>
            /**
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 100px 25px;
            }

            main {
                margin-top: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: -80px;
                left: 0px;
                right: 0px;
                height: 350px;
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: -80px;
                padding-top: 5px;
                left: 0px;
                right: 0px;
                text-align: center;
                width: 100%;
                border-top: 0.1px solid black;
                font-size: 10px;
            }

            .header1 {
                text-align: center;
                width: 300px;
                font-size: 10px;
                float: left;
            }

            .header3 {
                width: 150px;
                float: left;
            }

            .header2 {
                text-align: center;
                width: 300px;
                font-size: 10px;
                float: left;
            }

            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }

            .titre {
                border: solid 2px black;
                text-align: center;
                padding: 10px;
                font-size: 14px;
            }

            .table {
                border: solid 2px black;
                padding: 10px;
                font: 11px 'Courier New';
                width: 100%;
            }

            .border {
                border: 1px solid black;
                font: 11px 'Courier New';
                width: 100%;
            }

            .center {
                text-align: center;
            }

            #watermark {
                position: fixed;
                bottom:   8cm;
                left:     5.5cm;
                width:    8cm;
                height:   8cm;
                z-index:  -1000;
            }

        </style>
    </head>
    <body>

    <!-- Define header and footer blocks before your content -->
    <header class="clearfix">
        <div class="header1">
            MINISTERE DE L’ECONOMIE ET DE LA RELANCE <br>
            ------------------ <br>
            SECRETARIAT GENERAL <br>
            ------------------ <br>
            <b>DIRECTION GENERALE DE LA CONCURRENCE ET <br> DE LA CONSOMMATION</b>
            <br><br>
            N° <b>{{ $odr->getNumOdr() }}</b> /MER/SG/DGCC
        </div>
        <div class="header3"></div>
        <div class="header2">
            <div style="border-top: solid 2px gray; border-bottom: solid 10px gray; width: 80px; padding: 10px 0px; float: right">
                N° {{ $odr->getNumOdr() }}
            </div>
            <br><br><br><br><br>
            <img src="data:image/jpg;base64,{{ $image }}" width="120" style="float: right" />
        </div>
    </header>

    <footer>
        Direction Générale de la Concurrence et de la Consommation <br>
        Avenue Jean Félix EBOUE B.P : 1064 Libreville (Gabon) / Tél. : 011 79 50 14
    </footer>

    <div id="watermark">
        <img src="data:image/jpg;base64,{{ $filigrane }}" height="400" width="400" />
    </div>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <h4 class="titre">ORDRE DE RECETTE</h4>

        <table class="table">
            <tr>
                <td style="width: 130px">NOM DU DEBITEUR :</td>
                <td style="width: 330px"><b>{{ $amc->getContribuable->raisonsociale }}</b></td>

                <td>TEL :</td>
                <td><b>{{ $amc->getContribuable->tel }}</b></td>
            </tr>
            <tr>
                <td>NUMERO STATISTIQUE :</td>
                <td><b>{{ $amc->getContribuable->nif }}</b></td>

                <td>ADRESSE :</td>
                <td><b>{{ $amc->getContribuable->siegesocial }}</b></td>
            </tr>
        </table>
        <br>
        <table class="border" border="1" cellspacing="0">
            <tr class="center">
                <th colspan="4">
                    REFERENCE DU TITRE
                </th>
            </tr>
            <tr class="center">
                <th width="70px">EXERCICE</th>
                <th width="70px">DATE <br>D’EMISSION</th>
                <th width="300px">IMPUTATION COMPTABLE</th>
                <th width="100px">SERVICE <br> EMETTEUR</th>
            </tr>
            <tr class="center">
                <td style="padding-bottom: 7%">{{ $odr->exercice }}</td>
                <td>{{ date_format(new DateTime($odr->date_emission), 'd/m/Y') }}</td>
                <td style="text-align: left; padding: 0% 3%">4741-241 recette et contentieux de la Concurrence et de la Consommation.</td>
                <td><b>DCN</b></td>
            </tr>
            <tr>
                <th colspan="2" style="padding-bottom: 2%">NATURE DE L’OPERATION</th>
                <th>ELEMENT DE LIQUIDATION</th>
                <th>MONTANT</th>
            </tr>
            <tr>
                <td style="padding: 0% 0% 3% 3%" colspan="2">FRAIS D’INSPECTION ET D'ENREGISTREMENT</td>
                <td style="padding: 0% 3%">En application des dispositions de l’arrête
                    <b>n°0029/MEDEPIP/CAB/SG/DGCC du 09 juin 2016 portant
                    modification de l’arrêté 1067.</b></td>
                <td style="text-align: right; padding: 0% 3%">{{ number_format($amc->totalenr, 0, '.', ' ')  }} F CFA</td>
            </tr>
            @foreach($amc->getProduitAmcs as $prodAmcs)
            <tr>
                <td style="padding: 0% 0% 0.5% 3%" colspan="2">{{ strtoupper($prodAmcs->getProduit->libelle)  }}</td>
                <td style="padding: 0% 0% 0.5% 3%">{{ number_format($prodAmcs->poids, 0, '.', ' ').'KG * '.number_format($prodAmcs->getProduit->montant, 0, '.', ' ')  }}</td>
                <td style="padding: 0% 3%; text-align: right">{{ number_format($prodAmcs->total, 0, '.', ' ')  }} F CFA</td>
            </tr>
            @endforeach
            @if($amc->totalpen != 0)
                <tr>
                    <td style="padding: 0% 0% 0.5% 3%" colspan="2"></td>
                    <td style="padding: 0% 0% 0.5% 3%">
                        PENALITES APPLIQUEES
                    </td>
                    <td style="padding: 0% 3%; text-align: right">
                        {{ number_format($amc->totalpen, 0, '.', ' ') }} F CFA
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="3"></td>
                <th style="padding-bottom: 3%; text-align: center">SOMME DUE</th>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th style="padding-bottom: 3%; text-align: right">
                    {{ number_format($amc->totalglobal, 0, '.', ' ') }} F CFA
                </th>
            </tr>
        </table>
        <br><br>
        <div style="text-align: center; font-size: 11px;">
            <b><u>IMPORTANT :</u></b> TOUTE SOMME PAYEE DOIT ETRE COMPTABILISEE DANS LE <b><u>COMPTE : 4751-241 </u></b><br>
                <b>RECETTES ET CONTENTIEUX DE LA CONCURRENCE ET DE LA CONSOMMATION</b>
        </div>
        <br><br><br><br>
        <div style="font-size: 11px; margin-left: 70%">
            Fait à Libreville, le :
        </div>
        <div style="font-size: 11px; margin-left: 70%">
            <b><u>LE REGISSEUR</u></b>

            <img src="data:image/jpg;base64,{{ $sign_odr }}" width="200"  />

            <b>Jacob Calixte OTHA</b>
        </div>

    </main>

    </body>

</html>
