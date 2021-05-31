@extends('layout.auth')

@section('content')
<div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        <div class="text-center"><a href='https://www.freepik.com/vectors/avatar'>Avatar vector created by stories - www.freepik.com</a></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Account Activation</h1>
                            </div>
                            <form class="user" action="{{ url('/activate') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="verification_code"
                                            placeholder="verification_code" name="verification_code">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Activate
                                </button>
                            </form>
                            <hr>
                            <!--<div class="text-center">
                                <a class="small" href="/">Tidak mendapatkan email?</a>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop