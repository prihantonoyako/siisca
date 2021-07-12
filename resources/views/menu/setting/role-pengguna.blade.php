@extends('layout.app')
@section('head')
<link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">MANAGEMENT PERAN PENGGUNA</h6>
		</div>
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
					<a href="{{url('setting/menu/create')}}" class="btn btn-primary btn-circle">
							<i class="fas fa-plus"></i>
						</a>
					</div>
					<div class="col-sm-8">
					</div>
				</div>
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered" id="tabel_menu" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th colspan="6" class="text-center">Informasi Peran Pengguna</th>
									<th colspan="2" class="text-center">Action</th>
								</tr>
								<tr>
									<th>Urutan</th>
									<th>Nama</th>
									<th>Group</th>
									<th>URL</th>
									<th>Icon</th>
									<th>Aktif</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($menuDB as $item)
								<tr>
									<td>{{$item->urutan}}</td>
									<td>{{$item->nama_menu}}</td>
									<td>{{$item->belongsMenuGroup->nama_group}}</td>
									<td>{{$item->url_menu}}</td>
									<td>{{$item->icon}}</td>
									<td>{{$item->is_aktif}}</td>
									<td><a href="{{url('/setting/menu')}}/{{$item->id_menu}}/edit" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
									<td><a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
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
@endsection
@section('footer-script')
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#tabel_menu').DataTable();
	});
</script>
@endsection