@extends('layout.app')
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">FORM CREATE MENU</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session()->has('urutan_conflict'))
            <div class="alert alert-danger">
                invalid untuk urutan: {{session('urutan_conflict')}}
            </div>
            @endif
            <form action="{{url('setting/menu')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nama_menu">Nama Menu:</label>
                    <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="{{old('nama_menu')}}" placeholder="Enter menu name:">
                </div>
                <div class="form-group">
                    <label for="id_group">Group:</label>
                    <select class="form-control" id="id_group" name="id_group">
                        @foreach($groupDB as $item)
                        <option value="{{$item['id_group']}}">{{$item["nama_group"]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="url_menu">URL:</label>
                    <input type="text" class="form-control" id="url_menu" name="url_menu" value="{{old('url_menu')}}" placeholder="Enter menu url:">
                </div>
                <div class="form-group">
                    <label for="icon">Icon Font Awesome:</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="{{old('icon')}}" placeholder="Enter menu icon:">
                </div>
                <div class="form-group">
                    <label for="urutan">Urutan Menu:</label>
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
                    <a href="{{url('setting/menu')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection