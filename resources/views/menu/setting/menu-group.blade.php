@extends('layout.app')
@section('head')
<link href="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">MANAGEMENT GROUP MENU</h6>
		</div>
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<a href="{{url(Request::url().'/create')}}" class="btn btn-primary btn-circle">
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
									<th colspan="4" class="text-center">Informasi Group Menu</th>
									<th rowspan="2">Status</th>
                                    <th colspan="2" class="text-center">Action</th>
								</tr>
								<tr>
									<th>Urutan</th>
									<th>Nama Group</th>
									<th>URL</th>
									<th>Icon</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($groupMenuDB as $item)
								<tr>
									<td>{{$item->urutan}}</td>
									<td>{{$item->nama_group}}</td>
									<td>{{$item->url_menu}}</td>
									<td>{{$item->icon}}</td>
									<td>
										@if($item->is_aktif==1)
										<input id="{{$item->id_group}}" class="toggle-event" type="checkbox" checked data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
										@else
										<input id="{{$item->id_group}}" class="toggle-event" type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
										@endif
									</td>
									<td><a href="{{url(Request::url())}}/{{$item->id_group}}/edit" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>
									<td>
										<a href="#" class="btn btn-danger btn-circle btn-sm deleteRecord" data-toggle="modal" data-target="#deleteModal" data-id="{{ $item->id_group }}">
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
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#tabel_menu').DataTable();
		$(document).on("change", ".toggle-event", function() {
			var id_group_menu = $(this).attr('id');
			var is_aktif = $(this).prop('checked');
			var url = "{{url('setting/group_menu/')}}/" + id_group_menu;
			$.ajax({
				url: url,
				type: "PATCH",
				cache: false,
				data: {
					_token: '{{ csrf_token() }}',
					is_aktif: is_aktif
				},
				success: function() {
					swal({
						title: "Success",
						text: "Menu has been updated",
						icon: "success",
						timer: 1000
					});
				}
			});
		});
		$(".deleteRecord").click(function() {
			var id = $(this).data("id");
			$(".deleteConfirm").click(function() {
				var token = $("meta[name='csrf-token']").attr("content");
				$.ajax({
					url: "{{ url('setting/group_menu') }}" + "/" + id,
					type: 'DELETE',
					data: {
						"id": id,
						"_token": token,
					},
					success: function() {
						swal({
						title: "Success",
						text: "Access has been updated",
						icon: "success",
						timer: 1000
					});
						location.reload();
					},
					error: function() {
						swal({
							title: "Aw Snaps!",
							text: "Something went wrong while delete access record",
							icon: "error",
							timer: "2000"
						});
					}
				});
			});
		});
	});
</script>
@endsection