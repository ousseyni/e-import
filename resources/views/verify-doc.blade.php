<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
</head>
<body>
<style>
    main {
        display: flex;
        align-items: center;
        justify-items: center;
        align-content: flex-end;
        justify-content: space-around;
        height: 85vh;
    }

    h1 {
        text-transform: uppercase;
        font-size: 0.9em;
        border-bottom: 3px solid #066f06;
        color: #066f06;
        font-weight: bold;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 10px;
        text-align: center;
    }

    .card-attestation {
        padding: 20px;
        background: #08b6e038;
        border-radius: 8px;
    }

    section {
        padding: 30px;
        min-width: 90vw;
    }

    span.small-text-description {
        display: block;
        margin: 10px 0px;
        font-size: 0.7em;
        color: grey;
        text-align:center;
    }

    .title {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 0.8em;
        margin-bottom: 20px;
    }

    .subtitle {
        font-size: 0.6em;
    }

    .content-data {
        font-size: 0.8em;
        text-transform: uppercase;
        font-weight: bold;
    }

    .content {
        /* margin-top: 10px; */
    }

    .content-item {
        margin-top: 10px;
    }

    tr, td, th {
        border: 1px solid;
        padding: 6px 13px;
        font-size: 0.8em;
    }

    table {
        margin-top: 20px;
    }

    ul.head-align {
        width: 100%;
        display: flex;
        list-style: none;
        align-items: stretch;
        flex-direction: row;
        margin: 0;
        padding: 0;
        justify-content: space-around;
        align-content: stretch;
    }

    ul.head-align li {
        display: flex;
        font-weight: bold;
        font-size: 0.7em;
        text-transform: uppercase;
        color: white;
        max-width: 120px;
        display: block;
        text-align: center;
        align-items: center;
    }

    ul.head-align li img {
        max-width: 51px;
    }

    nav.navbar.navbar-expand-lg.navbar-light.bg-primary {
        background: #435879 !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <ul class="head-align">
        <li class="head-align-image">
            <img src="{{ url('/storage/img/dgcc.png') }}" alt="">
        </li>
        <li class="head-align-image">
            <img src="{{ url('/storage/img/sceau.jpg') }}" alt="">
        </li>
    </ul>



</nav>

<main>

    <section>
        <h1>Authentification d'autorisation</h1>
        @if($isExiste)
            <span class="small-text-description">Cette autorisation a bien été délivrée par les services de la Direction Générale de la Concurrence et de la Consommation</span>
        @else
            <span class="small-text-description" style="color: red;">Autorisation non authentique - Cette autorisation n'est pas reconnue par les services de la Direction Générale de la Concurrence et de la Consommation </span>
        @endif
        <div class="card-attestation">
            @if($type == 'AMM')
                <div class="title">Autorisation de Mise sur le Marché</div>
            @else
                <div class="title">Autorisation de Mise en Consommation</div>
            @endif
            <div class="content">
                <div class="content-item">
                    <div class="subtitle">Raison sociale</div>
                    <div class="content-data">{{ $demande->getContribuable->raisonsociale }}</div>
                </div>
                <div class="content-item">
                    <div class="subtitle">N° Statistique</div>
                    <div class="content-data">{{ $demande->getContribuable->nif }}</div>
                </div>
                <div class="content-item">
                    <div class="subtitle">Délivrée le </div>
                    <div class="content-data">31/01/1987</div>
                </div>
                <div class="content-item">
                    <div class="subtitle">Code du dossier</div>
                    <div class="content-data">{{ $demande->getNumDemande() }}</div>
                </div>
                <table>
                    <tr>
                        <td>Provenance :</td>
                        <th>{{ $demande->paysprov }}</th>
                    </tr>

                    <tr>
                        <td>Mode de transport</td>
                        <th>{{ $demande->modetransport }}</th>
                    </tr>
                </table>
                <div style="display: flex;justify-content: center;margin-top: 20px;">
                    <img src="{{ url('/storage/img/yes.png') }}" alt="" width="50">
                </div>
            </div>
        </div>
    </section>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
