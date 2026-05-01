# JOBSHEET PRAKTIKUM PERTEMUAN 10
## Implementasi Sorting (Ascending & Descending) pada Table Filament

**Mata Kuliah:** Pemrograman Web Lanjut  
**Pertemuan:** 10  
**Framework:** Filament

- Nama: Muhammad Febriansyah
- NIM: 244107020199
- Kelas: TI-2F
- Mata Kuliah: Pemrograman Web Lanjut

## A. Latar Belakang

Pada modul Post, kita sudah memiliki tabel dengan kolom:
- Image
- Title
- Slug
- Category
- Created At

Namun saat data bertambah banyak, pengguna membutuhkan fitur:
- Urut berdasarkan Title (A–Z / Z–A)
- Urut berdasarkan Tanggal terbaru
- Urut berdasarkan Category

Filament menyediakan fitur sorting yang sangat sederhana dan powerful.

---

## B. Konsep Sorting di Filament

### Pada Laravel Biasa
Sorting membutuhkan:
- Query manual
- Kondisi `orderBy`
- Parameter request
- Logic yang kompleks

### Pada Filament
Cukup dengan satu method:
```php
->sortable()
```

Filament secara otomatis menangani semua logic sorting di background!

---

## C. Implementasi Sorting pada Kolom Title

**File:** `PostResource.php`

**Ubah kolom Title menjadi:**
```php
TextColumn::make('title')
    ->sortable(),
```

**Hasil:**
- Simpan dan refresh halaman
- Klik header "Title" untuk mengaktifkan sorting
- Klik 1× → Ascending (A–Z)
- Klik 2× → Descending (Z–A)

**Screenshot:**
```
[Sorting Title Ascending/Descending]
```
(img/10-1.jpg)
---

## D. Sorting pada Kolom Slug

**Implementasi:**
```php
TextColumn::make('slug')
    ->sortable(),
```

**Hasil:**
- Refresh → Kolom Slug bisa diurutkan
- Header Slug akan menampilkan icon sort saat di-hover

---

## E. Sorting pada Relasi (Category)

Jika ingin mengurutkan berdasarkan nama kategori:

```php
TextColumn::make('category.name')
    ->sortable(),
```

**Keunggulan:**
- Filament otomatis menangani join relasi
- Tidak perlu manual query
- Performance tetap optimal

---

## F. Sorting pada Kolom Tanggal

Tambahkan kolom Created At dengan sorting:

```php
TextColumn::make('created_at')
    ->label('Created At')
    ->dateTime()
    ->sortable(),
```

**Hasil:**
- Bisa diurutkan berdasarkan tanggal terbaru atau terlama
- Format tanggal otomatis tertampil rapi

**Screenshot:**
```
[Sorting Created At]
```
(img/10-2.jpg)
---

## G. Mengatur Default Sorting

Jika ingin tabel otomatis urut berdasarkan kolom tertentu:

**Tambahkan pada konfigurasi table:**
```php
->defaultSort('created_at', 'desc')
```

**Contoh Lengkap:**
```php
public static function table(Table $table): Table
{
    return $table
        ->defaultSort('created_at', 'desc')
        ->columns([
            TextColumn::make('title')->sortable(),
            TextColumn::make('slug')->sortable(),
            TextColumn::make('category.name')->sortable(),
            ColorColumn::make('color')->sortable(),
            ImageColumn::make('image')->disk('public')->sortable(),
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}
```

**Screenshot:**
```
[Default Sort Created At Descending]
```
(img/10-3.jpg)
---

## 📊 H. Opsi Default Sort Lain

| Opsi | Fungsi |
|------|--------|
| `asc` | Urut naik (A–Z / 0–9) |
| `desc` | Urut turun (Z–A / 9–0) |

**Contoh:**
```php
->defaultSort('created_at', 'desc')
```

**Artinya:**
- Data terbaru tampil paling atas
- User tidak perlu klik sorting secara manual saat pertama kali load

---

## I. Ringkasan Method Sorting

| Method | Fungsi |
|--------|--------|
| `sortable()` | Mengaktifkan sorting kolom |
| `defaultSort()` | Mengatur sorting default |
| `dateTime()` | Format tanggal |
| `label()` | Mengubah nama kolom |

---

##  J. Hasil yang Diharapkan

Mahasiswa berhasil:

-  Mengaktifkan `sortable()` pada Title
-  Mengaktifkan `sortable()` pada Slug
-  Mengaktifkan `sortable()` pada relasi Category
-  Mengaktifkan `sortable()` pada Created At
-  Mengatur default sorting berdasarkan Created At (Descending)
-  Semua kolom teks dapat di-sort

---

## K. Latihan Praktikum

### Tugas:

1. **Aktifkan sorting pada semua kolom teks**
   - Title 
   - Slug 
   - Category 
   - Created At 

2. **Buat default sorting berdasarkan Created At descending**
   - `->defaultSort('created_at', 'desc')`

3. **Uji sorting ascending dan descending**
   - Klik header kolom untuk test
   - Verifikasi urutan data

4. **Screenshot:**
   - Sorting Title Ascending
   (img/10-1.jpg)
   - Sorting Title Descending
   (img/10-3.jpg)
   - Sorting Date Descending (default)
   (img/10-3.jpg)

---

## L. Analisis & Diskusi

### Pertanyaan:

#### 1. Mengapa sorting penting pada admin panel?

**Jawaban:**
- **User Experience**: Memudahkan admin mencari dan melihat data yang penting
- **Efficiency**: Mempercepat proses pencarian tanpa perlu filter tambahan
- **Data Management**: Dengan data besar, sorting sangat esensial untuk manajemen
- **Priority**: Admin dapat langsung melihat data terbaru atau paling penting

**Contoh Penggunaan:**
- Melihat post terbaru di posisi paling atas
- Mengurutkan berdasarkan kategori untuk manajemen lebih baik
- Mencari data berdasarkan title secara A-Z

---

#### 2. Apa perbedaan sortable biasa dengan defaultSort()?

**Jawaban:**

| Aspek | `sortable()` | `defaultSort()` |
|-------|------------|-----------------|
| **Fungsi** | Mengaktifkan fitur sort pada kolom | Mengatur urutan saat pertama load |
| **User Action** | Perlu diklik user | Otomatis tanpa action user |
| **Timing** | Aktif setiap saat | Hanya saat pertama load |
| **Contoh** | `->sortable()` | `->defaultSort('created_at', 'desc')` |

**Analisis:**
- `sortable()` = Memberikan kemampuan sort kepada user
- `defaultSort()` = Menentukan urutan default saat halaman pertama kali dibuka

---

#### 3. Mengapa relasi tetap bisa di-sort?

**Jawaban:**
- **Filament Magic**: Filament secara otomatis membuat JOIN query ke tabel relasi
- **Database Level**: Sorting dilakukan langsung di database, bukan di PHP
- **Performance**: Tetap optimal karena database yang handle, bukan aplikasi
- **Syntax Simple**: Developer hanya perlu tuliskan `'category.name'`, Filament urus sisanya

**Contoh Query yang Dihasilkan:**
```sql
SELECT posts.* FROM posts
LEFT JOIN categories ON posts.category_id = categories.id
ORDER BY categories.name ASC
```

Filament otomatis generate query di atas!

---

#### 4. Kapan kita menggunakan desc sebagai default?

**Jawaban:**

**Gunakan `desc` ketika:**
-  Menampilkan data terbaru di posisi atas (Created At, Updated At)
-  Menampilkan transaksi terbaru terlebih dahulu
-  Konten blog/artikel terbaru tampil pertama
-  Activity log atau timeline

**Gunakan `asc` ketika:**
-  Menampilkan data alphabetically (A-Z untuk names, titles)
-  Menampilkan urutan berdasarkan nomor (ID kecil ke besar)
-  List yang sudah terurut secara natural (category, priority)

---

## M. Kesimpulan

Pada pertemuan ini mahasiswa telah mempelajari:

1. **Implementasi Sorting Tabel**
   - Menggunakan method `sortable()` untuk setiap kolom
   - Fitur sorting bekerja dengan sekali klik header kolom

2. **Sorting Relasi Database**
   - Filament otomatis handle JOIN relasi
   - Syntax sederhana: `'category.name'`

3. **Sorting Kolom Tanggal**
   - Kombinasi `dateTime()` dan `sortable()`
   - Format tampilan otomatis rapi

4. **Default Sorting pada Filament**
   - `defaultSort()` mengatur urutan saat load
   - `asc` vs `desc` sesuai kebutuhan


