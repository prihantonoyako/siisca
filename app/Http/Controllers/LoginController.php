<?php

namespace App\Http\Controllers;

use App\Http\Traits\PenggunaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna\PenggunaModel;

class LoginController extends Controller
{
    use PenggunaTrait;

    public function show(){
        if(Auth::check()){
            $id_role = session('id_role');
            $url = 'dashboard/' . $id_role;
            return redirect($url);
        }
        return view('portal.login');
    }

    public function authenticate(Request $request){
        if(Auth::attempt([
            'username'=>$request->username,
            'password'=>$request->password,
            'is_aktif'=>'1'])) {
            $request->session()->regenerate();
            $id_pengguna = Auth::id();
            $id_role = PenggunaModel::find($id_pengguna)->hasRole()->first();
            session([
                'id_pengguna'=>$id_pengguna,
                'id_role'=>$id_role->id_role
                ]);
            $url = route('dashboard', ['id_role' => $id_role->id_role]);
            return redirect($url);
        }

        return back()->withErrors([
            'status' => 'Your credentials does not match with ours'
        ]);
    }

    public function logout(Request $request){
        $user = Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register(){
        return view('portal.register');
    }
}
