# Dokumentasi Jobsheet Pertemuan 5

Dokumentasi ini berisi rangkuman Jobsheet 5-1, 5-2, dan 5-3 pada project Filament App. Materi mencakup instalasi dan setup Filament, pembuatan CRUD Resource dengan Filament, serta pembuatan migration, model, relasi, dan Category Resource.

- Nama: Muhammad Febriansyah
- NIM: 244107020199
- Kelas: TI-2F
- Mata Kuliah: Pemrograman Web Lanjut

## Struktur Materi

1. Jobsheet 5-1 - Instalasi dan Setup Filament
2. Jobsheet 5-2 - Membuat CRUD Resource dengan Filament
3. Jobsheet 5-3 - Membuat Migration, Model, Relasi, dan Category Resource

---

## Jobsheet 5-1 - Instalasi dan Setup Filament

Pada tahap ini dilakukan instalasi Filament pada proyek Laravel agar tersedia panel admin untuk mengelola data aplikasi.

### Langkah-Langkah

1. Memastikan proyek Laravel sudah berjalan dengan baik.
2. Menginstal package Filament menggunakan Composer.
3. Menjalankan perintah instalasi panel Filament.
4. Melakukan konfigurasi awal autentikasi admin.
5. Menjalankan migrasi database untuk tabel bawaan Laravel dan Filament.
6. Membuat user admin untuk login ke panel.
7. Mengakses panel Filament melalui route admin.

### Analisis dan Diskusi

1. Mengapa Filament dipilih untuk admin panel Laravel?

Jawaban: Karena Filament menyediakan komponen siap pakai untuk form, tabel, dan resource CRUD sehingga pengembangan admin panel menjadi lebih cepat, terstruktur, dan konsisten.

2. Mengapa migrasi perlu dijalankan setelah instalasi?

Jawaban: Karena Filament dan Laravel membutuhkan tabel database tertentu (user, password reset, session, dan tabel lain yang relevan) agar fitur login, manajemen data, dan panel dapat berjalan normal.

3. Apa fungsi akun admin pada setup awal?

Jawaban: Akun admin digunakan untuk autentikasi ke panel Filament sehingga hanya pengguna yang berwenang yang bisa mengakses fitur manajemen data.

4. Apa dampaknya jika konfigurasi environment database salah?

Jawaban: Migrasi akan gagal, koneksi database tidak terbentuk, dan panel admin tidak dapat digunakan untuk membaca atau menyimpan data.

### Hasil Akhir Jobsheet 5-1

Tambahkan screenshot hasil instalasi dan tampilan login panel admin pada bagian ini.

---

## Jobsheet 5-2 - Membuat CRUD Resource dengan Filament

Pada tahap ini dibuat Resource Filament untuk melakukan operasi CRUD (Create, Read, Update, Delete) terhadap entitas utama di aplikasi.

### Langkah-Langkah

1. Membuat resource baru menggunakan perintah artisan Filament.
2. Menyesuaikan schema form pada method form() sesuai field tabel.
3. Menyesuaikan kolom tabel pada method table() agar data tampil informatif.
4. Menambahkan validasi pada field penting seperti required dan unique.
5. Mengaktifkan fitur pencarian dan pengurutan data.
6. Menguji proses tambah, ubah, lihat, dan hapus data dari panel admin.

### Analisis dan Diskusi

1. Mengapa Resource menjadi fitur utama di Filament?

Jawaban: Resource adalah pusat konfigurasi CRUD karena menyatukan definisi form, tabel, halaman list, create, edit, dan aksi lain dalam satu struktur yang rapi.

2. Apa manfaat validasi langsung di form Resource?

Jawaban: Validasi menjaga kualitas data sejak input awal, mengurangi data tidak valid, dan meminimalkan error saat proses simpan ke database.

3. Mengapa field pada form dan kolom pada tabel tidak selalu sama?

Jawaban: Form berfokus pada kebutuhan input, sedangkan tabel berfokus pada ringkasan data yang mudah dibaca. Karena itu hanya informasi penting yang biasanya ditampilkan di tabel.

4. Kapan kita perlu menambahkan fitur search dan sort?

Jawaban: Saat data mulai banyak sehingga admin membutuhkan cara cepat untuk menemukan data tertentu dan mengurutkannya berdasarkan kriteria seperti nama atau tanggal.

### Hasil Akhir Jobsheet 5-2

Tambahkan screenshot halaman list data dan form create/edit resource pada bagian ini.

---

## Jobsheet 5-3 - Membuat Migration, Model, Relasi, dan Category Resource

Pada tahap ini dibuat struktur data kategori secara lengkap, mulai dari migration tabel categories, model Category, relasi antar model, hingga Category Resource pada Filament.

### Langkah-Langkah

1. Membuat migration untuk tabel categories.
2. Menentukan kolom tabel categories (misalnya name, slug, description).
3. Menjalankan migrasi agar tabel categories dibuat di database.
4. Membuat model Category.
5. Menambahkan relasi pada model Category dan model terkait (misalnya hasMany dan belongsTo).
6. Menambahkan foreign key category_id pada tabel entitas terkait jika dibutuhkan.
7. Membuat Category Resource di Filament.
8. Menyesuaikan form dan tabel Category Resource.
9. Menguji relasi data kategori pada proses input dan tampilan data.

### Analisis dan Diskusi

1. Mengapa migration penting sebelum membuat Resource?

Jawaban: Karena Resource bekerja di atas tabel database. Jika struktur tabel belum ada, form dan tabel pada Resource tidak bisa menyimpan atau menampilkan data.

2. Apa fungsi relasi hasMany dan belongsTo dalam kasus kategori?

Jawaban: belongsTo digunakan pada model data utama yang memiliki satu kategori, sedangkan hasMany digunakan pada model Category untuk menunjukkan satu kategori dapat memiliki banyak data terkait.

3. Mengapa foreign key category_id harus konsisten?

Jawaban: Konsistensi foreign key menjaga integritas relasi data sehingga query relasi berjalan benar dan mencegah data orphan (data tanpa pasangan relasi).

4. Apa manfaat membuat Category Resource terpisah?

Jawaban: Admin dapat mengelola master data kategori secara mandiri, sehingga saat membuat data utama kategori tinggal dipilih dari data yang sudah tersedia.

### Hasil Akhir Jobsheet 5-3

Tambahkan screenshot tabel kategori, form kategori, dan bukti relasi kategori pada resource terkait.

---

## Catatan Tambahan

- Jika menggunakan gambar dokumentasi, simpan pada folder dokumentasi/img/.
- Gunakan nama file gambar yang konsisten agar mudah direferensikan di README.
- Sesuaikan isi field dan relasi dengan struktur tabel yang digunakan pada proyek.
