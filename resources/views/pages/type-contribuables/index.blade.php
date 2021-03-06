@extends('layouts.app', ['page_name' => 'Type de contribuables',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Gestion des contribuables'])

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">

                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                    @endif

                    <div class="table-responsive mb-4 mt-4">
                        <a href="{{ route('type-contribuables.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouveau type</a>
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Libelle</th>
                                    <th width="3%"></th>
                                    <th width="3%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($typecontribuables as $typecontribuable)
                                <tr>
                                    <td>{{$typecontribuable->libelle}}</td>
                                    <td>
                                        @if(!in_array($typecontribuable->id, array(1, 2, 3)))
                                        <a href="{{ route('type-contribuables.edit', $typecontribuable->slug)}}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!in_array($typecontribuable->id, array(1, 2, 3)))
                                        <form id="form_del_{{ $loop->index }}" action="{{ route('type-contribuables.destroy', $typecontribuable->slug) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="submit_form('form_del_{{ $loop->index }}')"><i class="far fa-trash-alt"></i></a>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
