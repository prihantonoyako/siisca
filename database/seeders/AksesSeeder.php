<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = DB::table('menu')->pluck('id_menu');
        foreach($menu as $value){
        DB::table('akses')->insert([
            'id_role' => DB::table('role')->where('nama_role','developer')->value('id_role'),
            'id_menu' => $value,
            'is_aktif' => '1',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        }
    }
}
