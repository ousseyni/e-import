@extends('layouts.app', ['page_name' => 'Tableau de bord',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Accueil'])


@section('content')


    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-3 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-secondary">
                                <h6 class="value">{{ number_format($tab_societe[0], 0, '.', ' ')  }}</h6>
                                <p class="text-secondary"><b>Sociétés</b></p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-success">
                                <h6 class="value">{{ number_format($tab_societe[1], 0, '.', ' ')  }}</h6>
                                <p class="text-success"><b>Importateurs</b></p>
                            </div>
                            <div class=" ext-success">
                                <div class="w-icon">
                                    <i data-feather="user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-primary">
                                <h6 class="value">{{ number_format($tab_societe[2], 0, '.', ' ')  }}</h6>
                                <p class="text-warning"><b>Exportateurs</b></p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i data-feather="user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <div class="w-content">
                            <div class="w-warning">
                                <h6 class="value">{{ number_format($tab_societe[3], 0, '.', ' ')  }}</h6>
                                <p class="text-danger"><b>Producteurs locaux</b></p>
                            </div>
                            <div class="">
                                <div class="w-icon">
                                    <i data-feather="user-x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 layout-spacing">
                <div class="widget widget-card-four">
                    <div class="widget-content">
                        <table class="table">
                            <tr>
                                <td>Date début: </td>
                                <td>
                                     <input class="form-control form-control-sm" type="date" value="{{ date('Y').'-01-01'  }}" name="date_debut" id="date_debut">
                                </td>
                                <td>Date fin : </td>
                                <td>
                                    <input class="form-control form-control-sm" type="date" value="{{ date('Y-m-d')  }}" name="date_fin" id="date_fin">
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

                        <!--div class="order-summary">

                            <div class="summary-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                </div>
                                <div class="w-summary-details">
                                    <div class="w-summary-info">
                                        <h6>Demandes reçues</h6>
                                        <p class="summary-count">92,600</p>
                                    </div>
                                    <div class="w-summary-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="summary-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                </div>
                                <div class="w-summary-details">
                                    <div class="w-summary-info">
                                        <h6>Demandes signées</h6>
                                        <p class="summary-count">37,515</p>
                                    </div>
                                    <div class="w-summary-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="summary-list">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                </div>
                                <div class="w-summary-details">
                                    <div class="w-summary-info">
                                        <h6>Demandes rejetées</h6>
                                        <p class="summary-count">$55,085</p>
                                    </div>
                                    <div class="w-summary-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div-->

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

                            <!--div class="order-summary">

                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                    </div>
                                    <div class="w-summary-details">
                                        <div class="w-summary-info">
                                            <h6>Demandes reçues</h6>
                                            <p class="summary-count">92,600</p>
                                        </div>
                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                    </div>
                                    <div class="w-summary-details">
                                        <div class="w-summary-info">
                                            <h6>Demandes signées</h6>
                                            <p class="summary-count">37,515</p>
                                        </div>
                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                    </div>
                                    <div class="w-summary-details">
                                        <div class="w-summary-info">
                                            <h6>Demandes rejetées</h6>
                                            <p class="summary-count">$55,085</p>
                                        </div>
                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div-->

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

                    document.location.href = '/dashboard/admin/'+date_debut+'/'+date_fin;
                });

            });

        </script>

