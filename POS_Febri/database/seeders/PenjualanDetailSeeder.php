<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $detail_id = 1;
        for ($i = 1; $i <= 10; $i++) { // loop 10 transaksi
            for ($j = 1; $j <= 3; $j++) { // loop 3 barang per transaksi
                $barang_id = rand(1, 15);
                $qty = rand(1, 2);
                $data[] = [
                    'detail_id' => $detail_id++,
                    'penjualan_id' => $i,
                    'barang_id' => $barang_id,
                    'qty' => $qty,
                    'subtotal' => $qty * rand(1500000, 30000000),
                ];
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
