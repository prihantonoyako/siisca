<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna\PenggunaModel;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       $foto = "Images/Avatar/default_avatar.png";
       $pengguna = new PenggunaModel;
       $pengguna->username = $username;
       $pengguna->password = $password;
       $pengguna->nama_depan = $nama_depan;
       $pengguna->nama_belakang = $nama_belakang;
       $pengguna->email = $email;
       $pengguna->foto = $foto;
       $pengguna->save();
       $random = Str::random(40);
       $base64_confirm = base64_encode($random);
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
}
