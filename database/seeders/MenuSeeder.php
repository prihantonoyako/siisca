<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_group')->insert([
            'nama_group' => 'Statistik',
            'icon' => 'fa-line-chart'
        ]);
        DB::table('menu_group')->insert([
            'nama_group' => 'Account',
            'icon' => 'fa-users'
        ]);
        DB::table('menu')->insert([
            'id_group' => 1,
            'nama_menu' => 'kelembapan',
            'url_menu' => '/statistik/kelembapan',
            'icon' => 'fa-tint'
        ]);
        DB::table('menu')->insert([
            'id_group' => 1,
            'nama_menu' => 'suhu',
            'url_menu' => '/statistik/suhu',
            'icon' => 'fa-thermometer-full'
        ]);
    }
}
