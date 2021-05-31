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
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="{{ url('/register') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nama_depan"
                                            placeholder="Nama Depan" name="nama_depan">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="nama_belakang"
                                            placeholder="Nama Belakang" name="nama_belakang">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        placeholder="Alamat Email" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username"
                                        placeholder="Username" name="username">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="password_confirm" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <!--
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                                -->
                            </form>
                            <hr>
                            <!--<div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>-->
                            <div class="text-center">
                                <a class="small" href="/">Already have an account? Login!</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop