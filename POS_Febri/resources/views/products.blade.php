<!DOCTYPE html>
<html>
<head>
    <title>Produk - {{ $category }}</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <h2>Kategori: {{ $category }}</h2>
    <ol>
        @foreach($products as $product)
            <li>{{ $product }}</li>
        @endforeach
    </ol>
    <hr>
    <a href="/">Kembali</a>
</body>
</html>
