<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class LevelController extends Controller
{
    public function index()
    {
        // Langkah 1: Mencoba Insert (Tambahkan data pelanggan)
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        
        // Langkah 2: Mencoba Update (Mengubah nama level yang baru dibuat)
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris';

        // Langkah 3: Mencoba Delete (Menghapus data)
        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        // Langkah 4: Menampilkan data (Select)
        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }
}