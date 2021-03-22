<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna\PenggunaModel;

class LoginController extends Controller
{
    public function show(){
        return view('portal.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->only('username','password');

        if(Auth::guard('pengguna')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'username' => 'username salah',
            'password' => 'password salah'
        ]);
    }

    // public function authenticate(Request $request){
    //     $pengguna = new PenggunaModel;
    //     $username = $request->input('username');
    //     $password = $request->input('password');
    //     $pengguna->where([
    //         'username' => $username,
    //         'password' => $password,
    //         'is_aktif' => 1
    //     ])->first();
    //     if($pengguna){
    //         redirect('/dashboard');
    //     }else {
    //         redirect('/');
    //     }
    // }

    public function logout(Request $request){
        return redirect('/');
    }

    public function register(){
        return view('portal.register');
    }
}
