<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $data = [
        ['supplier_id' => 1, 'supplier_kode' => 'GLX', 'supplier_nama' => 'Galaxy Store', 'supplier_alamat' => 'Malang'],
        ['supplier_id' => 2, 'supplier_kode' => 'MEG', 'supplier_nama' => 'Mega Elektronik', 'supplier_alamat' => 'Surabaya'],
        ['supplier_id' => 3, 'supplier_kode' => 'TCH', 'supplier_nama' => 'Tech Center', 'supplier_alamat' => 'Jakarta'],
    ];
    DB::table('m_supplier')->insert($data);
}
}
