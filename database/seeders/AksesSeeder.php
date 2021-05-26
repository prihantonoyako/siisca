<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'nama_role' => 'basic',
            'url' => 'basic'
        ]);
        DB::table('role')->insert([
            'nama_role' => 'premium',
            'url' => 'premium'
        ]);
        DB::table('akses')->insert([
            'id_role' => 1,
            'id_menu' => 1,
            'is_aktif' => '1'
        ]);
        DB::table('akses')->insert([
            'id_role' => 1,
            'id_menu' => 2,
            'is_aktif' => '1'
        ]);
        DB::table('akses')->insert([
            'id_role' => 2,
            'id_menu' => 1,
            'is_aktif' => '0'
        ]);
    }
}
