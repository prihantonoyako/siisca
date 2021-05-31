<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
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
            'url' => 'basic',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
        DB::table('role')->insert([
            'nama_role' => 'developer',
            'url' => 'developer',
            'created_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('+07:00')->format('Y-m-d H:i:s')
        ]);
    }
}
