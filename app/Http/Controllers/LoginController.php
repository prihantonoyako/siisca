<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Pengguna\PenggunaModel;

class LoginController extends Controller
{
    public function show(){
        return view('portal.login');
    }

    public function authenticate(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        $credentials = array(
            'username'=>$request->username,
            'password' => $request->password,
            'is_aktif' => "1"
        );
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'username' => 'username does not exist',
            'password' => 'password does not match with username'
        ]);
    }
    public function login(Request $request){
        $pengguna = new PenggunaModel;
        $username = $request->input('username');
        $password = $request->input('password');
        $pengguna->where([
            'username' => $username,
            'password' => $password
        ])->first();
        if($pengguna){
            redirect('/dashboard');
        }else {
            redirect('/');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

    public function register(){
        return view('portal.register');
    }
}
