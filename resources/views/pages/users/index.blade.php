@extends('layouts.app', ['page_name' => 'Utilisateurs',
                         'has_scrollspy' => 'Your Title Goes Here',
                         'scrollspy_offset' => 'Your Title Goes Here',
                         'category_name' => 'Administration'])

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
                        <a href="{{ route('users.create')  }}" class="btn btn-outline-info btn-sm text-right mb-1">Nouvel utilisateur</a>
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>Nom & prénom(s)</th>
                                <th>Email</th>
                                <th>Login</th>
                                <th>Profil</th>
                                <th width="3%"></th>
                                <th width="3%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->login }}</td>
                                    <td>{{ (is_null($user->profilid) ? 'ND' : $user->getProfil->libelle) }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->slug) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @if($user->id != 1 && $user->profilid != 2)
                                            <form id="form_del_{{ $loop->index }}" action="{{ route('users.destroy', $user->slug) }}" method="post">
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
