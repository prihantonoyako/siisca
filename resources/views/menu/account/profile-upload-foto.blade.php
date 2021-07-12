@extends('layout.app')
@section('head')
<link href="{{ asset('codepen/aaronvanston.css') }}" rel="stylesheet" type="text/css">
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Form Upload Foto</h6>
  </div>
  <div class="card-body">
    <form method="post" id="upload-image-form" enctype="multipart/form-data">
      @csrf
      <div class="file-upload">
        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
        <div class="image-upload-wrap">
          <input class="file-upload-input" name="foto" type='file' onchange="readURL(this);" accept="image/*" />
          <input type="hidden" name="id_pengguna" value="{{ $id_pengguna }}" />
          <div class="drag-text">
            <h3>Drag and drop a file or select add Image</h3>
          </div>
        </div>
        <div class="file-upload-content">
          <img class="file-upload-image" src="#" alt="your image" />
          <div class="image-title-wrap">
            <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
            <button type="submit" class="btn btn-primary">SAVE</button>
          </div>
        </div>
      </div>
    </form>
    <div>
      <a href="{{ url('account/profile/'.$id_pengguna) }}" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-hand-point-left"></i>
        </span>
        <span class="text">Back To Profile</span>
      </a>
    </div>
  </div>
</div>
@endsection
@section('footer-script')
<script src="{{ asset('codepen/aaronvanston.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#upload-image-form').submit(function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
      type: 'POST',
      url: "{{ url('account/profile/avatar/upload_avatar_proses') }}",
      data: formData,
      contentType: false,
      processData: false,
      success: (response) => {
        if (response) {
          this.reset();
          swal({
            title: "Success",
            text: "Your profile has been updated.",
            icon: "success",
            timer: 2000
          });
        }
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
</script>
@endsection