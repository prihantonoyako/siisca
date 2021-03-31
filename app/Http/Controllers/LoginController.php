<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PenggunaModel;

class LoginController extends Controller
{
    public function show(){
        if(Auth::guard('pengguna')->check()){
            return redirect('dashboard');
        }
        return view('portal.login');
    }
    public function authenticate(Request $request){
        if(Auth::guard('pengguna')->attempt([
            'username'=>$request->username,
            'password'=>$request->password,
            'is_aktif'=>1])){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'username' => 'username salah',
            'password' => 'password salah'
        ]);
    }
    public function logout(Request $request){
        Auth::guard('pengguna')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function register(){
        return view('portal.register');
    }
}
