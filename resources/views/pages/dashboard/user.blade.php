@extends('layouts.app', ['page_name' => 'Tableau de bord',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Accueil'])


@section('content')


    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <table class="table">
                            <tr>
                                <td>Date début: </td>
                                <td>
                                     <input class="form-control form-control-sm" type="date" value="{{ date('Y').'-01-01' }}" name="date_debut" id="date_debut">
                                </td>
                                <td>Date fin : </td>
                                <td>
                                    <input class="form-control form-control-sm" type="date" value="{{ date('Y-m-d') }}" name="date_fin" id="date_fin">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success" id="refreshDashboard">Valider</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            @if($withRange)
            <div class="col-12 layout-spacing">
                <div class="widget-three">
                    <div class="widget-">

                    </div>
                    <div class="widget-content">

                        <table class="table">
                            <caption>Statistiques sur les AMC</caption>
                            <tr>
                                <th>Enregistrés <br>et étudiés</th>
                                <th>Mis en dépotage</th>
                                <th>Dépotage effectif</th>
                                <th>Rejet après étude</th>
                                <th>Transmis pour signature</th>
                                <th>Montant AMC</th>
                                <th>Valeurs CAF (FCFA)</th>
                                <th>Poids total (Kg)</th>
                                <th>Nbre total conteneurs</th>
                                <th>Conteneurs inspectés</th>
                            </tr>
                            <tr>
                                <td>{{ $stat_amc[0] }}</td>
                                <td>{{ $stat_amc[1] }}</td>
                                <td>{{ $stat_amc[2] }}</td>
                                <td>{{ $stat_amc[3] }}</td>
                                <td>
                                    {{ $stat_amc[4] }}
                                    @if($stat_amc[0] != 0)
                                        ({{ round(100*($stat_amc[4]/$stat_amc[0]), 2) }}%)
                                    @endif
                                </td>
                                <td>{{ number_format($stat_amc[5], 0, '.', ' ')  }}</td>
                                <td>{{ number_format($stat_amc[6], 0, '.', ' ')  }}</td>
                                <td>{{ number_format($stat_amc[7], 0, '.', ' ')  }}</td>

                                <td>{{ $stat_cont[0] }}</td>
                                <td>
                                    {{ $stat_cont[1] }}
                                    @if($stat_cont[0] != 0)
                                        ({{ round(100*($stat_cont[1]/$stat_cont[0]), 2) }}%)
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

                <hr>

                <div class="col-12 layout-spacing">
                    <div class="widget-three">
                        <div class="widget-">

                        </div>
                        <div class="widget-content">

                            <table class="table">
                                <caption>Statistiques sur les AMM</caption>
                                <tr>
                                    <th>Enregistrés <br>et étudiés</th>
                                    <th>Mis en dépotage</th>
                                    <th>Dépotage effectif</th>
                                    <th>Rejet après étude</th>
                                    <th>Transmis pour signature</th>
                                    <th>Montant AMC</th>
                                    <th>Valeurs CAF (FCFA)</th>
                                    <th>Poids total (Kg)</th>
                                    <th>Nbre total conteneurs</th>
                                    <th>Conteneurs inspectés</th>
                                </tr>
                                <tr>
                                    <td>{{ $stat_amm[0] }}</td>
                                    <td>{{ $stat_amm[1] }}</td>
                                    <td>{{ $stat_amm[2] }}</td>
                                    <td>{{ $stat_amm[3] }}</td>
                                    <td>
                                        {{ $stat_amm[4] }}
                                        @if($stat_amm[0] != 0)
                                            ({{ round(100*($stat_amm[4]/$stat_amm[0]), 2) }}%)
                                        @endif
                                    </td>
                                    <td>{{ number_format($stat_amm[5], 0, '.', ' ')  }}</td>
                                    <td>{{ number_format($stat_amm[6], 0, '.', ' ')  }}</td>
                                    <td>{{ number_format($stat_amm[7], 0, '.', ' ')  }}</td>

                                    <td>{{ $stat_cont_2[0] }}</td>
                                    <td>
                                        {{ $stat_cont_2[1] }}
                                        @if($stat_cont_2[0] != 0)
                                            ({{ round(100*($stat_cont_2[1]/$stat_cont_2[0]), 2) }}%)
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            <div id="container"></div>
            @endif

        </div>
        @endsection

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('body').on('click', '#refreshDashboard', function () {
                    var date_debut = $('#date_debut').val();
                    var date_fin = $('#date_fin').val();

                    document.location.href = '/dashboard/user/'+date_debut+'/'+date_fin;
                });

            });

        </script>

