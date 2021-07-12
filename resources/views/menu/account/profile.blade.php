@extends('layout.app')
@section('head')
<link href="{{ asset('bootdey/css/profile.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container bootdey flex-grow-1 container-p-y">

    <div class="media align-items-center py-3 mb-3">
        @if(is_null($pengguna->foto))
        <img src="{{ asset('Images/Avatar/default_avatar.png') }}" alt="" class="d-block ui-w-100 rounded-circle">
        @else
        <img src="{{ asset('storage/'.$pengguna->foto) }}" alt="" class="d-block ui-w-100 rounded-circle">
        @endif
        <div class="media-body ml-4">
            <h4 class="font-weight-bold mb-0">{{ $pengguna->nama_pengguna }}
                <span class="text-muted font-weight-normal">@ {{ $pengguna->username }}</span>
            </h4>
            <div class="text-muted mb-2">ID: {{ $pengguna->id_pengguna }}</div>
            <a href="{{ url('account/profile') }}/{{ $pengguna->id_pengguna }}/edit" class="btn btn-primary btn-sm">Edit</a>&nbsp;
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <table class="table user-view-table m-0">
                <tbody>
                    <tr>
                        <td>Registered:</td>
                        <td>{{ $pengguna->registered }}</td>
                    </tr>
                    <tr>
                        <td>Latest activity:</td>
                        <td>{{ $pengguna->update_profile }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle">Role:</td>
                        <td>
                            <table class="table-responsive table card-table m-0">
                    </tr>
                    @foreach($penggunaDetail['roles'] as $item)
                    <td>{{ $item['nama_role'] }}</td>
                    @endforeach
                    </tr>
            </table>
            <td>
                </tr>
                </tbody>
                </table>
        </div>
        <hr class="border-light m-0">
        <div class="table-responsive">
            <table class="table card-table m-0">
                <tbody>
                    <tr>
                        <th>Menu/Group</th>
                        @foreach($menuName as $item)
                        <th class="text-uppercase text-center">{{ $item["nama_menu"] }}/{{ $item["id_group"] }}</th>
                        @endforeach
                    </tr>
                    @foreach($penggunaDetail['roles'] as $item)
                    <tr>
                        <td>{{ $item['nama_role'] }}</td>
                        @foreach($permissionModules[$item['id_role']] as $itemPermission)
                        @foreach($itemPermission as $check)
                        @if($check)
                        <td class="text-center"><span class="fa fa-check text-primary"></span></td>
                        @else
                        <td class="text-center"><span class="fa fa-times text-light"></span></td>
                        @endif
                        @endforeach
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <!-- <div class="row no-gutters row-bordered">
            <div class="d-flex col-md align-items-center">
                <a href="javascript:void(0)" class="card-body d-block text-body">
                    <div class="text-muted small line-height-1">Posts</div>
                    <div class="text-xlarge">125</div>
                </a>
            </div>
            <div class="d-flex col-md align-items-center">
                <a href="javascript:void(0)" class="card-body d-block text-body">
                    <div class="text-muted small line-height-1">Followers</div>
                    <div class="text-xlarge">534</div>
                </a>
            </div>
            <div class="d-flex col-md align-items-center">
                <a href="javascript:void(0)" class="card-body d-block text-body">
                    <div class="text-muted small line-height-1">Following</div>
                    <div class="text-xlarge">236</div>
                </a>
            </div>
        </div> -->
        <hr class="border-light m-0">
        <div class="card-body">

            <table class="table user-view-table m-0">
                <tbody>
                    <tr>
                        <td>Username:</td>
                        <td>{{ $pengguna->username }}</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>{{ $pengguna->nama_pengguna }}</td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td>{{ $pengguna->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection