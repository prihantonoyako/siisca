<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengguna')->insert([
            'username' => 'prihantonoyako',
            'password' => Hash::make('123'),
            'nama_depan' => 'Yako',
            'nama_belakang' => 'Prihantono',
            'email' => 'prihantonoyako@gmail.com',
            'foto' => 'Images\Avatar\default_avatar.png',
            'is_aktif' => '1'
        ]);
        DB::table('pengguna')->insert([
            'username' => 'okayonotnahirp',
            'password' => Hash::make('123'),
            'nama_depan' => 'Okay',
            'nama_belakang' => 'Onotnahirp',
            'email' => 'yakoprihantono@student.uns.ac.id',
            'foto' => 'Images\Avatar\default_avatar.png',
            'is_aktif' => '1'
        ]);
        DB::table('role_pengguna')->insert([
            'id_pengguna' => 1,
            'id_role' => 1,
        ]);
        DB::table('role_pengguna')->insert([
            'id_pengguna' => 2,
            'id_role' => 2,
        ]);
    }
}
