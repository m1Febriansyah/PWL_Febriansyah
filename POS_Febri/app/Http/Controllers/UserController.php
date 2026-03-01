<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // --- Praktikum 6: Eloquent ORM ---

        // Langkah 1: Insert menggunakan Eloquent
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345'),
        // ];
        // UserModel::create($data);

        // Langkah 2: Update menggunakan Eloquent
        // $data = [
        //     'nama' => 'Manager Dua Upd',
        // ];
        // UserModel::where('username', 'manager_dua')->update($data);

        // Langkah 3: Delete menggunakan Eloquent
        // UserModel::where('username', 'manager_dua')->delete();

        // Langkah 4: Select/Get menggunakan Eloquent + relasi level
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }
}
