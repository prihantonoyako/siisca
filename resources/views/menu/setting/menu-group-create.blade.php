@extends('layout.app')
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">FORM CREATE GROUP MENU</h6>
        </div>
        <div class="card-body">
        <div class="alert alert-danger" role="alert">
                invalid untuk urutan: {{$urutanSuggestion}}
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{url('setting/group_menu')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama_group">Nama Group Menu:</label>
                    <input type="text" class="form-control" id="nama_group" name="nama_group" placeholder="Enter group menu name:">
                </div>
                <div class="form-group">
                    <label for="url_group">URL:</label>
                    <input type="text" class="form-control" id="url_group" name="url_group" placeholder="Enter group menu url:">
                </div>
                <div class="form-group">
                    <label for="icon">Icon Font Awesome:</label>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Enter group menu icon:">
                </div>
                <div class="form-group">
                    <label for="urutan">Urutan Group Menu:</label>
                    <input type="number" class="form-control" id="urutan" name="urutan" min="1" required>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">Status Aktif:</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_aktif" name="is_aktif">
                            <label class="form-check-label" for="is_aktif">
                                Check me to activate
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 bg-light text-right">
                    <a href="{{url('setting/group_menu')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('urutan_conflict'))
<script>
$(document).ready(function() {
    swal({
        title: "Sorry!",
        text: "Ganti urutan menu",
        icon: "error",
        timer: 5000
    });
});
</script>
@endif
@endsection