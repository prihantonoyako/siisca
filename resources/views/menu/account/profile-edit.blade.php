@extends('layout.app')
@section('head')
<link href="{{ asset('bootdey/css/profile-edit.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
	<div class="row gutters">
		<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
			<div class="card h-100">
				<div class="card-body">
					<div class="account-settings">
						<div class="user-profile">
							<div class="user-avatar">
								@if(is_null($pengguna->foto))
								<img src="{{ asset('Images/Avatar/default_avatar.png') }}" alt="">
								@else
								<img src="{{ asset('storage/'.$pengguna->foto) }}" alt="">
								@endif
							</div>
							<h5 class="user-name">{{ $pengguna->username }}</h5>
							<h6 class="user-email">{{ $pengguna->email }}</h6>
							<br>
							<a href="{{ url('account/profile/avatar/'.$pengguna->id_pengguna) }}" class="btn btn-primary btn-icon-split">
								<span class="icon text-white-50">
									<i class="fas fa-upload"></i>
								</span>
								<span class="text">Upload Profile</span>
							</a>
						</div>
						<!--<div class="about">
							<h5>About</h5>
							<p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human experiences.</p>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
			<div class="card h-100">
				<div class="card-body">
					<div class="row gutters">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<h6 class="mb-2 text-primary">Personal Details</h6>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group">
								<label for="namaDepean">Nama Depan</label>
								<input type="text" class="form-control" id="nama_depan" value="{{ $pengguna->nama_depan }}">
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group">
								<label for="namaBelakang">Nama Belakang</label>
								<input type="text" class="form-control" id="nama_belakang" value="{{ $pengguna->nama_belakang }}">
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
							<div class="form-group">
								<label for="eMail">Email</label>
								<input type="email" class="form-control" id="eMail" value="{{ $pengguna->email }}">
							</div>
						</div>
					</div>
					<div class="row gutters">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="text-right">
								<button type="button" id="submit" name="submit" class="btn btn-primary update_data">Update</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer-script')
<script>
	$(document).ready(function() {
		$(".update_data").click(function() {
			var url = "{{ url('account/profile/'.$pengguna->id_pengguna) }}";
			$.ajax({
				url: url,
				type: "PUT",
				cache: false,
				data: {
					_token: '{{ csrf_token() }}',
					nama_depan: $('#nama_depan').val(),
					nama_belakang: $('#nama_belakang').val(),
					email: $('#eMail').val(),
				},
				success: function() {
					swal({
						title: "Success",
						text: "Your profile has been updated.",
						icon: "success",
						timer: 1000
					});
				},
				error: function(xhr) {
					swal({
						title: "Oops!",
						text: "Something went wrong.",
						icon: "error",
						timer: 1000
					});
				}
			});
		});
	});
</script>
@endsection