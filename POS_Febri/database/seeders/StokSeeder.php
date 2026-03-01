<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'stok_id' => $i,
                'barang_id' => $i, // Menghubungkan ke barang_id 1 sampai 15
                'user_id' => 1,    // Merujuk ke admin (user_id 1)
                'stok_tanggal' => now(),
                'stok_jumlah' => rand(10, 100), // Jumlah stok acak
            ];
        }
        DB::table('t_stok')->insert($data);
    }
}