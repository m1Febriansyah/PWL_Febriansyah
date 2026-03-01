<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class LevelController extends Controller
{
    public function index()
    {
        // --- Praktikum 5: Query Builder ---

        // Langkah 1: Insert menggunakan Query Builder
        // DB::table('m_level')->insert([
        //     'level_kode' => 'CUS',
        //     'level_nama' => 'Pelanggan',
        //     'created_at' => now(),
        // ]);

        // Langkah 2: Update menggunakan Query Builder
        // $row = DB::table('m_level')->where('level_kode', 'CUS')->update(['level_nama' => 'Customer']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // Langkah 3: Delete menggunakan Query Builder
        // $row = DB::table('m_level')->where('level_kode', 'CUS')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // Langkah 4: Select/Get menggunakan Query Builder
        $data = DB::table('m_level')->get();
        return view('level', ['data' => $data]);
    }
}