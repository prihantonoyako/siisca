@extends('layout.app')
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">FORM EDIT MENU</h6>
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
            <form action="{{url('setting/menu')}}/{{$menuDB->id_menu}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="nama_menu">Nama Menu:</label>
                    <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="{{$menuDB->nama_menu}}">
                </div>
                <div class="form-group">
                    <label for="id_group">Group:</label>
                    <select class="form-control" id="id_group" name="id_group">
                        <option value="{{$menuDB->belongsMenuGroup->id_group}}" selected>{{$menuDB->belongsMenuGroup->nama_group}}</option>
                        @foreach($groupDB as $item)
                        <option value="{{$item['id_group']}}">{{$item["nama_group"]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="url_menu">URL:</label>
                    <input type="text" class="form-control" id="url_menu" name="url_menu" placeholder="{{$menuDB->url_menu}}">
                </div>
                <div class="form-group">
                    <label for="icon">Icon Font Awesome:</label>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="{{$menuDB->icon}}">
                </div>
                <div class="form-group">
                    <label for="urutan">Urutan Menu:</label>
                    <input type="number" class="form-control" id="urutan" name="urutan" min="1" value={{$menuDB->urutan}}>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">Status Aktif:</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            @if($menuDB->is_aktif==0)
                            <input class="form-check-input" type="checkbox" id="is_aktif" name="is_aktif">
                            @else
                            <input class="form-check-input" type="checkbox" id="is_aktif" name="is_aktif" checked>
                            @endif
                            <label class="form-check-label" for="is_aktif">
                                Check me to activate
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 bg-light text-right">
                    <a href="{{url('setting/menu')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
<script>
$(document).ready(function() {
    swal({
        title: "Success",
        text: "Menu has been updated",
        icon: "success",
        timer: 2000
    });
});
</script>
@endif
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