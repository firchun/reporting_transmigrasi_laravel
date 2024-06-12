<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidang')->insert([
            'nama_bidang' => 'Penempatan Tenaga Kerja (Pentaker)',
            'keterangan_bidang' => 'Bidang bagian penempatan tenaga kerja'
        ]);
        DB::table('bidang')->insert([
            'nama_bidang' => 'Hubungan Industrial',
            'keterangan_bidang' => 'Bidang bagian hubungan industrial'
        ]);
        DB::table('bidang')->insert([
            'nama_bidang' => 'Perencanaan Tenaga kerja, Pelatihan, dan Produktivitas Kerja',
            'keterangan_bidang' => 'Bidang bagian perencanaan tenaga kerja, pelatihan, dan produktivitas kerja'
        ]);
        DB::table('bidang')->insert([
            'nama_bidang' => 'Transmigrasi',
            'keterangan_bidang' => 'Bidang bagian transmigrasi'
        ]);
    }
}
