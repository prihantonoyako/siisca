<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
            'urutan' => 1,
            'nama_group' => 'statistik',
            'url_group' => 'statistik',
            'icon' => 'fa-chart-line',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('menu_group')->insert([
            'urutan' => 2,
            'nama_group' => 'account',
            'url_group' => 'account',
            'icon' => 'fa-users',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('menu_group')->insert([
            'urutan' => 3,
            'nama_group' => 'setting',
            'url_group' => 'setting',
            'icon' => 'fa-wrench',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);

        //group statistik
        DB::table('menu')->insert([
            'id_group' => 1,
            'urutan' => 1,
            'nama_menu' => 'overview',
            'url_menu' => 'overview',
            'icon' => 'fa-eyes',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);

        //group account
        DB::table('menu')->insert([
            'id_group' => 2,
            'urutan' => 1,
            'nama_menu' => 'profile',
            'url_menu' => 'profile',
            'icon' => 'fa-user',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('menu')->insert([
            'id_group' => 2,
            'urutan' => 2,
            'nama_menu' => 'subscription',
            'url_menu' => 'subscription',
            'icon' => 'fa-user',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);

        //group setting
        DB::table('menu')->insert([
            'id_group' => 3,
            'urutan' => 1,
            'nama_menu' => 'menu',
            'url_menu' => 'menu',
            'icon' => 'fa-user',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('menu')->insert([
            'id_group' => 3,
            'urutan' => 2,
            'nama_menu' => 'role',
            'url_menu' => 'role',
            'icon' => 'fa-user',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('menu')->insert([
            'id_group' => 3,
            'urutan' => 3,
            'nama_menu' => 'hak akses',
            'url_menu' => 'hak_akses',
            'icon' => 'fa-user',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('menu')->insert([
            'id_group' => 3,
            'urutan' => 4,
            'nama_menu' => 'subscription',
            'url_menu' => 'subscription',
            'icon' => 'fa-user',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
    }
}
