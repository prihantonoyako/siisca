<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

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
            'username' => 'developer',
            'password' => Hash::make('123'),
            'nama_depan' => 'Yako',
            'nama_belakang' => 'Prihantono',
            'email' => 'prihantonoyako@gmail.com',
            'foto' => 'Images\Avatar\default_avatar.png',
            'is_aktif' => '1',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('role_pengguna')->insert([
            'id_pengguna' => DB::table('pengguna')->where('username','developer')->value('id_pengguna'),
            'id_role' => DB::table('role')->where('nama_role','developer')->value('id_role')
        ]);
    }
}
