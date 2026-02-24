<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return 'Selamat Datang';
    }
    public function about() {
        return 'Nama :Muhammad Febriansyah, NIM :244107020199';
    }
    public function articles($id) {
        return 'Artikel ke-'.$id;
    }   
}
