@extends('layout.app')
@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">FORM CREATE HAK AKSES</h6>
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
            <form action="{{url('setting/hak_akses')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="id_role">Role:</label>
                    <select class="form-control" id="id_role" name="id_role">
                        <option value="#">Choose role to give access:</option>
                        @foreach($roleDB as $item)
                        <option value="{{$item['id_role']}}">{{$item["nama_role"]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_menu">Menu:</label>
                    <select class="form-control" id="id_menu" name="id_menu">
                        <option value="#">Choose menu:</option>
                    </select>
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
                    <a href="{{url('setting/hak_akses')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script>
    $(document).on("change", "#id_role", function() {
        var sel = document.getElementById('id_menu');
        if(sel!=null){
        for (i = sel.length - 1; i >= 0; i--) {
            sel.remove(i);
        }}
        var id_role = $('#id_role').val();
        var url = "{{url('setting/hak_akses/')}}/" + id_role;
        $.ajax({
            url: url,
            type: "GET",
            cache: false,
            success: function(result) {
                result.forEach((data, i) => {
                    var element = document.createElement('option');
                    var pilihan = data.nama_group + "/" + data.nama_menu;
                    element.value = data.id_menu;
                    element.textContent = pilihan;
                    $("#id_menu").append(element);
                });
                // var txt1 = "<p>Text.</p>";
                // txt1.innerHTML = "Text."; // Create text with DOM
                // $("#id_menu2").append(txt1); // Append new elements
            }
        });
    });
</script>
@endsection