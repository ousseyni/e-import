@extends('layouts.app', ['page_name' => "Etude des demandes",
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Traitement des A.M.M.'])

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-10 col-lg-10 col-sm-10  layout-spacing">

                <div class="widget-content widget-content-area animated-underline-content">

                    <h4>Trace de la demande d'AMM <strong>N° {{ $amm->getNumDemande() }}</strong> </h4>
                    <hr>
                    <div class="mt-container mx-auto">
                        <div class="timeline-alter">
                            @foreach($traces as $trace)
                                <div class="item-timeline">
                                    <div class="t-time">
                                        <p class="small" style="font-size: 15px">{{ date_format($trace->created_at, 'd/m/Y')  }}</p>
                                    </div>
                                    <div class="t-img">
                                        @if($trace->etat == 1 || $trace->etat == 7)
                                            <img src="{{url('/storage/img/usager.png')}}">
                                        @else
                                            <img src="{{url('/storage/img/lg-dgcc.png')}}">
                                        @endif
                                    </div>
                                    <div class="t-meta-time">
                                        Par {{ $trace->getUser->name  }} <br>
                                        (à  {{ date_format($trace->created_at, 'H:i')  }})
                                    </div>

                                    <div class="t-text">
                                        <p>{{ $trace->comments }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
