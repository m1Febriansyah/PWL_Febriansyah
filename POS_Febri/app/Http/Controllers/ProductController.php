<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['category' => 'Semua Produk']);
    }

    public function foodBeverage()
    {
        $products = ['Nasi Goreng', 'Mie Ayam', 'Es Teh Manis', 'Roti Bakar'];
        return view('products', ['category' => 'Food & Beverage', 'products' => $products]);
    }

    public function beautyHealth()
    {
        $products = ['Sabun Muka', 'Lipstik', 'Sunscreen', 'Masker Wajah'];
        return view('products', ['category' => 'Beauty & Health', 'products' => $products]);
    }

    public function homeCare()
    {
        $products = ['Pembersih Lantai', 'Sabun Cuci', 'Pewangi Ruangan', 'Spons Cuci Piring'];
        return view('products', ['category' => 'Home Care', 'products' => $products]);
    }

    public function babyKid()
    {
        $products = ['Susu Formula', 'Popok Bayi', 'Bedak Bayi', 'Minyak Telon'];
        return view('products', ['category' => 'Baby & Kid', 'products' => $products]);
    }
}
