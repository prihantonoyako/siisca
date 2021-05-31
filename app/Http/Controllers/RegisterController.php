<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\Pengguna\PenggunaModel;
use App\Models\Registration;
use App\Mail\RegistrationMail;
use App\Models\Pengguna\RoleModel;
use App\Models\Pengguna\RolePenggunaModel;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portal.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $username = $request->input('username');
       $password = Hash::make($request->input('password'));
       $nama_depan = $request->input('nama_depan');
       $nama_belakang = $request->input('nama_belakang');
       $email = $request->input('email');
       $pengguna = new PenggunaModel;
       $pengguna->username = $username;
       $pengguna->password = $password;
       $pengguna->nama_depan = $nama_depan;
       $pengguna->nama_belakang = $nama_belakang;
       $pengguna->email = $email;
       $pengguna->save();
       $registration = new Registration;
       $id_pengguna = $pengguna->id_pengguna;
       $random = Str::random(40);
       $base64_confirm = base64_encode($random);
       $registration->id_pengguna = $id_pengguna;
       $registration->verification_code = $random;
       $registration->save();
       $nama_pengguna = $nama_depan . " " . $nama_belakang;
       $send_email = Mail::to($email)->send(new RegistrationMail($nama_pengguna,$base64_confirm));
       return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activation(){
        return view('portal.activation');
    }

    public function activate(Request $request){
        $verification_code = $request->verification_code;
        $kode = base64_decode($verification_code);
        $registration = Registration::where('verification_code',$kode)->first();
        $id_pengguna = $registration->id_pengguna;
        $role = RoleModel::where('nama_role','basic')->first();
        $id_role = $role->id_role;
        $pengguna = PenggunaModel::find($id_pengguna);
        $pengguna->is_aktif = '1';
        $pengguna->save();
        $role_pengguna = new RolePenggunaModel;
        $role_pengguna->id_pengguna = $id_pengguna;
        $role_pengguna->id_role = $id_role;
        $role_pengguna->save();
        return redirect('/');
    }
}
