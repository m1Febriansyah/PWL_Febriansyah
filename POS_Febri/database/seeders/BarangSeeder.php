<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $data = [
        // Supplier 1
        ['barang_id'=>1, 'kategori_id'=>2, 'supplier_id'=>1, 'barang_kode'=>'IPH15', 'barang_nama'=>'iPhone 15 Pro', 'harga_beli'=>18000000, 'harga_jual'=>20000000],
        ['barang_id'=>2, 'kategori_id'=>2, 'supplier_id'=>1, 'barang_kode'=>'SAM24', 'barang_nama'=>'Samsung S24 Ultra', 'harga_beli'=>19000000, 'harga_jual'=>21500000],
        ['barang_id'=>3, 'kategori_id'=>2, 'supplier_id'=>1, 'barang_kode'=>'OPP12', 'barang_nama'=>'Oppo Reno 12', 'harga_beli'=>6000000, 'harga_jual'=>7500000],
        ['barang_id'=>4, 'kategori_id'=>2, 'supplier_id'=>1, 'barang_kode'=>'XIA14', 'barang_nama'=>'Xiaomi 14', 'harga_beli'=>10000000, 'harga_jual'=>11500000],
        ['barang_id'=>5, 'kategori_id'=>2, 'supplier_id'=>1, 'barang_kode'=>'TAB9', 'barang_nama'=>'Galaxy Tab S9', 'harga_beli'=>12000000, 'harga_jual'=>14000000],
        // Supplier 2
        ['barang_id'=>6, 'kategori_id'=>4, 'supplier_id'=>2, 'barang_kode'=>'KUL01', 'barang_nama'=>'Kulkas LG 2 Pintu', 'harga_beli'=>3500000, 'harga_jual'=>4200000],
        ['barang_id'=>7, 'kategori_id'=>4, 'supplier_id'=>2, 'barang_kode'=>'AC001', 'barang_nama'=>'AC Sharp 1/2 PK', 'harga_beli'=>2800000, 'harga_jual'=>3400000],
        ['barang_id'=>8, 'kategori_id'=>4, 'supplier_id'=>2, 'barang_kode'=>'TV001', 'barang_nama'=>'Smart TV Sony 50"', 'harga_beli'=>7000000, 'harga_jual'=>8500000],
        ['barang_id'=>9, 'kategori_id'=>4, 'supplier_id'=>2, 'barang_kode'=>'MC001', 'barang_nama'=>'Mesin Cuci Polytron', 'harga_beli'=>2500000, 'harga_jual'=>3100000],
        ['barang_id'=>10, 'kategori_id'=>4, 'supplier_id'=>2, 'barang_kode'=>'MIC01', 'barang_nama'=>'Microwave Samsung', 'harga_beli'=>1500000, 'harga_jual'=>1900000],
        // Supplier 3
        ['barang_id'=>11, 'kategori_id'=>3, 'supplier_id'=>3, 'barang_kode'=>'MAC13', 'barang_nama'=>'MacBook Air M3', 'harga_beli'=>16000000, 'harga_jual'=>18500000],
        ['barang_id'=>12, 'kategori_id'=>3, 'supplier_id'=>3, 'barang_kode'=>'ROG16', 'barang_nama'=>'Asus ROG Zephyrus', 'harga_beli'=>25000000, 'harga_jual'=>28000000],
        ['barang_id'=>13, 'kategori_id'=>3, 'supplier_id'=>3, 'barang_kode'=>'LEN01', 'barang_nama'=>'Lenovo Legion 5', 'harga_beli'=>17000000, 'harga_jual'=>19500000],
        ['barang_id'=>14, 'kategori_id'=>1, 'supplier_id'=>3, 'barang_kode'=>'CAM01', 'barang_nama'=>'Sony A7 IV Body', 'harga_beli'=>30000000, 'harga_jual'=>33500000],
        ['barang_id'=>15, 'kategori_id'=>1, 'supplier_id'=>3, 'barang_kode'=>'DRN01', 'barang_nama'=>'DJI Mini 4 Pro', 'harga_beli'=>11000000, 'harga_jual'=>13000000],
    ];
    DB::table('m_barang')->insert($data);
}
}
