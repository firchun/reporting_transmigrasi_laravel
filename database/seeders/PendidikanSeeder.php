<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pendidikan')->insert([
            'nama_pendidikan' => 'SMA',
            'kepanjangan' => 'Sekolah Menengah Atas'
        ]);
        DB::table('pendidikan')->insert([
            'nama_pendidikan' => 'SMK',
            'kepanjangan' => 'Sekolah Menengah Kejuruan'
        ]);
    }
}
