@extends('layout.app')
@section('head')
<link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')


<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 text-uppercase">{{ Request::segment(2) }}</h1>
    <div class="row">
        <!-- DataTales Example -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DATA PENGGUNA AKTIF</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabelAktif" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($dataPenggunaAktif as $item)
                                <tr>
                                    <td>{{ $item[1] }}</td>
                                    <td>{{ $item[2] }}</td>
                                    <td>
                                        <a href="{{ url('account/profile') }}/{{ $item[0] }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ url('account/profile') }}/{{ $item[0] }}/edit" class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle btn-sm deleteRecord" data-toggle="modal" data-target="#deleteModal" data-id="{{ $item[0] }}">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DATA PENGGUNA INAKTIF</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabelInaktif" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($dataPenggunaInaktif as $item)
                                <tr>
                                    <td>{{ $item[1] }}</td>
                                    <td>{{ $item[2] }}</td>
                                    <td>
                                        <a href="{{ url('account/profile/') }}/{{ $item[0] }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ url('account/profile/$item[0]/edit') }}" class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle btn-sm deleteRecord" data-toggle="modal" data-target="#deleteModal" data-id="{{ $item[0] }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger deleteConfirm">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script>
    $(".deleteRecord").click(function() {
        var id = $(this).data("id");
        $(".deleteConfirm").click(function() {
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: "{{ url('account/profile') }}" + "/" + id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function() {
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
<!-- Page level plugins -->
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/js/demo/datatables-demo.js') }}"></script>
@endsection