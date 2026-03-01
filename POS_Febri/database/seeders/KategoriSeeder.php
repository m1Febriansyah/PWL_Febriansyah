<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $data = [
        ['kategori_id' => 1, 'kategori_kode' => 'ELC', 'kategori_nama' => 'Elektronik'],
        ['kategori_id' => 2, 'kategori_kode' => 'HHP', 'kategori_nama' => 'Handphone & Gadget'],
        ['kategori_id' => 3, 'kategori_kode' => 'LPT', 'kategori_nama' => 'Laptop & PC'],
        ['kategori_id' => 4, 'kategori_kode' => 'RMT', 'kategori_nama' => 'Rumah Tangga'],
        ['kategori_id' => 5, 'kategori_kode' => 'MDR', 'kategori_nama' => 'Mandiri/Lainnya'],
    ];
    DB::table('m_kategori')->insert($data);
}
}
