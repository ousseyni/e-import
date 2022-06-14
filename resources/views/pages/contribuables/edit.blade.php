@extends('layouts.app', ['page_name' => 'Modification contribuable',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Gestion des contribuables',])

@section('content')

    <div class="container">

        <div class="container">

            <div class="row layout-top-spacing">

                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Mise à jour d'un contribuable</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif

                            <form method="post" action="{{ route('contribuables.update', $contribuable->slug) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-row mb-4">
                                    <div class="col-6 input-group-sm">
                                        <label for="nif">NIF</label>
                                        <input type="text" name="nif" id="nif" class="form-control" value="{{ $contribuable->nif }}" />
                                    </div>
                                    <div class="col-6 input-group-sm">
                                        <label for="typecontribuableid">Type de contribution</label>
                                        <select class="form-control" id="typecontribuableid " name="typecontribuableid">
                                            @foreach($typeContribuables as $type)
                                                <option value="{{$type->id}}" {{ ($type->id === $contribuable->typecontribuableid ? 'selected' : '') }}>{{$type->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="col-12" id="msg" style="font-size: 10px"></span>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-12 input-group-sm">
                                        <label for="raisonsociale">Dénomination sociale</label>
                                        <input required="" type="text" id="raisonsociale" value="{{ $contribuable->raisonsociale }}" name="raisonsociale" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-6 input-group-sm">
                                        <label for="activiteid">Activité</label>
                                        <select class="form-control" id="activiteid" name="activiteid">
                                            <option value="">--- Choisir une activité ---</option>
                                            @foreach($activite as $act)
                                                <option {{ ($act->id == $contribuable->activiteid ? 'selected' : '')  }} value="{{$act->id}}">{{$act->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6 input-group-sm">
                                        <label for="sousactiviteid">Sous Activité</label>
                                        <select class="form-control" id="sousactiviteid" name="sousactiviteid">
                                            @foreach($sousactivite as $sact)
                                                <option {{ ($sact->id == $contribuable->sousactiviteid ? 'selected' : '')  }} value="{{$sact->id}}" class="{{$sact->activiteid}}">{{$sact->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-7 input-group-sm">
                                        <label for="siegesocial">Siège sociale</label>
                                        <input required="" type="text" class="form-control" id="siegesocial" value="{{ $contribuable->siegesocial }}" name="siegesocial" />
                                    </div>
                                    <div class="col-2 input-group-sm">
                                        <label for="bp">B.P.</label>
                                        <input type="text" class="form-control" id="bp" name="bp" value="{{ $contribuable->bp }}" />
                                    </div>
                                    <div class="col-3 input-group-sm">
                                        <label for="tel">Tél.</label>
                                        <input required="" type="text" class="form-control" id="tel" name="tel" value="{{ $contribuable->tel }}" />
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-4 input-group-sm">
                                        <label for="rccm">N° RCCM</label>
                                        <input required="" type="text" class="form-control" id="rccm" name="rccm" value="{{ $contribuable->rccm }}" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="numagrement">N° Agrément</label>
                                        <input type="text" class="form-control" id="numagrement" name="numagrement" value="{{ $contribuable->numagrement }}" />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="numcartecomm">N° Carte Com.</label>
                                        <input type="text" class="form-control" id="numcartecomm" name="numcartecomm" value="{{ $contribuable->numcartecomm }}" />
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-8 input-group-sm">
                                        <label for="nomprenom">Nom et Prénom Représentant Légal</label>
                                        <input required="" type="text" class="form-control" id="nomprenom" name="nomprenom" value="{{ $contribuable->nomprenom }}"  />
                                    </div>
                                    <div class="col-4 input-group-sm">
                                        <label for="email">Email</label>
                                        <input required="" type="email" class="form-control" id="email" name="email" value="{{ $contribuable->email }}" />
                                    </div>
                                </div>

                                <div class="form-row mb-4">
                                    <div class="col-4 input-group-sm">
                                        Joindre la fiche circuit
                                    </div>
                                    <div class="col-8 input-group-sm">
                                        <input type="file" class="custom-file-container__custom-file__custom-file-input" name="pj" />
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('blur', '#nif', function () {

            var nif_val = $('#nif').val();
            console.log(nif_val);

            $.ajax({
                type:"POST",
                url: "{{ url('contribuables/info') }}",
                data: { nif: nif_val },
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    if (res.nb === 0) {
                        $('#msg').html('Contribuable non pré-enregistré à la DGCC');
                        $('#raisonsociale').val('');
                        $('#siegesocial').val('');
                        $('#bp').val('');
                        $('#tel').val('');
                        $('#rccm').val('');
                        $('#numagrement').val('');
                        $('#numcartecomm').val('');
                        $('#nomprenom').val('');
                        $('#email').val('');
                    }
                    else {
                        $('#msg').html('Contribuable pré-enregistré à la DGCC');
                        $('#raisonsociale').val(res.data.raisonsociale);
                        $('#siegesocial').val(res.data.siegesocial);
                        $('#bp').val(res.data.bp);
                        $('#tel').val(res.data.tel);
                        $('#rccm').val(res.data.rccm);
                        $('#numagrement').val(res.data.numagrement);
                        $('#numcartecomm').val(res.data.numcartecomm);
                        $('#nomprenom').val(res.data.nomprenom);
                        $('#email').val(res.data.email);
                    }

                }
            });
        });

    });

</script>
