# JOBSHEET PRAKTIKUM PERTEMUAN 11
## Implementasi Search & Filter pada Table Filament

**Mata Kuliah:** Pemrograman Web Lanjut  
**Pertemuan:** 11  
**Framework:** Filament

- Nama: Muhammad Febriansyah
- NIM: 244107020199
- Kelas: TI-2F
- Mata Kuliah: Pemrograman Web Lanjut

## A. Latar Belakang

Pada modul Post sebelumnya, kita sudah menerapkan sorting pada tabel. Namun saat data bertambah sangat banyak, pengguna membutuhkan fitur:
- **Pencarian berdasarkan teks** (Title, Slug, Category)
- **Filter berdasarkan tanggal** (Created At)
- **Filter berdasarkan kategori** (Category)

Filament menyediakan fitur Search dan Filter yang sangat sederhana dan powerful.

---

## B. Konsep Search & Filter di Filament

### Pada Laravel Biasa
Search & Filter membutuhkan:
- Query manual dengan WHERE clause
- Kondisi IF untuk setiap filter
- Parameter request management
- Logic yang kompleks dan berulang
- Testing yang rumit

### Pada Filament
Cukup dengan dua method:
```php
->searchable()    // Untuk search
->filters()       // Untuk filter
```

Filament secara otomatis menangani semua logic di background!

---

## C. Implementasi Search pada Kolom Title

**File:** `PostResource.php`

**Ubah kolom Title menjadi:**
```php
TextColumn::make('title')
    ->sortable()
    ->searchable(),
```

**Hasil:**
- Simpan dan refresh halaman
- Search bar otomatis muncul di atas tabel
- Ketik di search bar untuk mencari berdasarkan Title
- Hasil tampil secara real-time (tanpa perlu klik tombol)

**Screenshot:**
```
[Search Title Real-time]
```
(img/11-1.jpg)

---

## D. Implementasi Search pada Kolom Slug & Category

**Slug:**
```php
TextColumn::make('slug')
    ->sortable()
    ->searchable(),
```

**Category (Relasi):**
```php
TextColumn::make('category.name')
    ->sortable()
    ->searchable(),
```

**Hasil:**
- Refresh → Ketiga kolom (Title, Slug, Category) bisa dicari
- Search box tetap satu, tapi bisa cari di 3 kolom sekaligus
- Pencarian bekerja di database level (sangat cepat)

---

## E. Membuat Filter Berdasarkan Tanggal (Date Filter)

Search cocok untuk teks, tetapi tidak efektif untuk tanggal. Solusinya: gunakan **Filter**.

**Tambahkan Import:**
```php
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
```

**Tambahkan pada method `table()` di bagian `->filters()`:**
```php
->filters([
    Filter::make('created_at')
        ->label('Creation Date')
        ->form([
            DatePicker::make('created_at')
                ->label('Select Date'),
        ])
        ->query(function ($query, $data) {
            return $query->when(
                $data['created_at'],
                fn ($query, $date) => $query->whereDate('created_at', $date)
            );
        }),
])
```

**Penjelasan:**
- `Filter::make('created_at')` → Nama filter
- `->label()` → Label yang tampil di UI
- `->form()` → Form component (DatePicker)
- `->query()` → Logic query filter (menggunakan `whereDate`)

**Hasil:**
- Ikon filter muncul di atas tabel
- User klik filter → muncul date picker
- Pilih tanggal → klik "Apply Filters" → data terfilter

**Screenshot:**
```
[Date Filter UI]
```
(img/11-3.jpg)

---

## F. Membuat Filter Berdasarkan Relasi (Select Filter)

Untuk filter berdasarkan kategori, gunakan **SelectFilter**.

**Tambahkan Import:**
```php
use Filament\Tables\Filters\SelectFilter;
```

**Tambahkan pada method `table()` di bagian `->filters()`:**
```php
->filters([
    Filter::make('created_at')
        ->label('Creation Date')
        ->form([
            DatePicker::make('created_at')
                ->label('Select Date'),
        ])
        ->query(function ($query, $data) {
            return $query->when(
                $data['created_at'],
                fn ($query, $date) => $query->whereDate('created_at', $date)
            );
        }),
    SelectFilter::make('category_id')
        ->label('Select Category')
        ->relationship('category', 'name')
        ->preload(),
])
```

**Penjelasan:**
- `SelectFilter::make('category_id')` → Filter berdasarkan column category_id
- `->relationship()` → Mengambil data dari relasi (category, tampilkan field name)
- `->preload()` → Preload data (performa lebih baik)

**Hasil:**
- Dropdown kategori muncul di filter
- User pilih kategori → data otomatis terfilter
- Bisa dikombinasikan dengan date filter

**Screenshot:**
```
[Select Filter Category]
```
(img/11-4.jpg)

---

## G. Kombinasi Search + Filter

Fitur search dan filter bisa bekerja bersamaan:

**Alur Penggunaan:**
1. User ketik di search box → data terfilter berdasarkan text
2. User pilih date filter → data terfilter berdasarkan tanggal
3. User pilih category → data terfilter berdasarkan kategori
4. Semua filter berjalan bersamaan (AND logic)

**Contoh User Journey:**
- Search: "Laravel" → tampil posts dengan title/slug/category mengandung "Laravel"
- Filter Date: "28-02-2026" → tampil posts yang dibuat pada tanggal tersebut
- Filter Category: "PHP" → tampil posts dengan kategori PHP
- Result: Posts yang di-created pada 28-02-2026 dengan kategori PHP dan mengandung "Laravel"

**Screenshot:**
```
[Combined Search + Filter UI]
```
(img/11-5.jpg)

---

## 📊 H. Perbandingan Search vs Filter

| Aspek | Search | Filter |
|-------|--------|--------|
| **Tipe Data** | Untuk teks | Untuk kondisi spesifik |
| **User Interaction** | Real-time typing | Form submission |
| **Cocok Untuk** | Title, Slug, Description | Tanggal, Kategori, Status |
| **Performance** | Cepat (database LIKE) | Cepat (database WHERE) |
| **Kombinasi** | Bisa digunakan bersamaan | Bisa digunakan bersamaan |

---

## I. Hasil yang Diharapkan

Mahasiswa berhasil:

- ✅ Mengaktifkan `searchable()` pada Title
- ✅ Mengaktifkan `searchable()` pada Slug
- ✅ Mengaktifkan `searchable()` pada Category (relasi)
- ✅ Membuat Filter berdasarkan tanggal (DatePicker)
- ✅ Membuat Filter berdasarkan kategori (SelectFilter)
- ✅ Menambahkan query custom pada filter
- ✅ Menggunakan Search dan Filter secara bersamaan

---

## J. Latihan Praktikum

### Tugas:

1. **Aktifkan Search pada minimal 3 kolom**
   - Title
   - Slug
   - Category (relasi)

2. **Buat Filter Berdasarkan Tanggal (Created At)**
   - Gunakan `Filter::make()`
   - Tambahkan `DatePicker`
   - Tambahkan query logic dengan `whereDate()`

3. **Buat Filter Berdasarkan Kategori**
   - Gunakan `SelectFilter::make()`
   - Hubungkan dengan relasi `category`

4. **Uji Kombinasi Search + Filter**
   - Cari berdasarkan text
   - Filter berdasarkan tanggal
   - Filter berdasarkan kategori
   - Pastikan semuanya berjalan bersama

5. **Screenshot (masing-masing):**
   - Search Title/Slug/Category
   (img/11-1.jpg)
   - Filter Tanggal (Date Picker UI)
   (img/11-2.jpg)
   - Filter Kategori (Select Dropdown)
   (img/11-3.jpg)
   - Kombinasi Search + Filter
   (img/11-4.jpg)

---

## K. Analisis & Diskusi

### Pertanyaan:

#### 1. Mengapa search tidak cocok untuk filter tanggal?

**Jawaban:**
- **Format Data**: Tanggal memiliki format spesifik (YYYY-MM-DD), search tidak cocok untuk range
- **User Experience**: Lebih mudah memilih dari date picker daripada mengetik format tanggal
- **Precision**: Date filter lebih presisi, bisa exact date atau range
- **Database Query**: Tanggal membutuhkan `WHERE` operator spesifik, bukan `LIKE`

**Contoh:**
- Search: Sulit mengetik "2026-02-28" dengan format tepat
- Filter: Cukup klik date picker, format otomatis

---

#### 2. Apa fungsi `relationship()` pada SelectFilter?

**Jawaban:**
- **Menghubungkan ke Relasi**: `relationship('category', 'name')` mengambil data dari tabel `categories`
- **Field Display**: Field `name` adalah yang ditampilkan di dropdown
- **Foreign Key**: Otomatis menggunakan `category_id` sebagai foreign key
- **JOIN Query**: Filament otomatis membuat JOIN untuk mengambil category names

**Contoh Query:**
```sql
SELECT DISTINCT categories.id, categories.name
FROM categories
ORDER BY categories.name ASC
```

---

#### 3. Mengapa kita perlu `whereDate()` pada query filter?

**Jawaban:**
- **Time Comparison**: `whereDate()` mengabaikan waktu (time portion)
- **Exact Date Match**: Hanya membandingkan tanggal, tidak jam:menit:detik
- **User Expectation**: User ingin filter berdasarkan tanggal saja, bukan waktu spesifik

**Contoh:**
```php
// Tanpa whereDate() - tidak match jika waktu berbeda
->where('created_at', '2026-02-28')  // TIDAK cocok

// Dengan whereDate() - match jika tanggal sama
->whereDate('created_at', '2026-02-28')  // COCOK
```

---

#### 4. Apa perbedaan `searchable()` dan `filters()`?

**Jawaban:**

| Aspek | `searchable()` | `filters()` |
|-------|---------------|-----------|
| **Implementasi** | Di kolom (TextColumn) | Di table level |
| **Trigger** | Real-time typing | Form submission |
| **Tipe Query** | LIKE (text matching) | WHERE/Date/Select |
| **Use Case** | Pencarian teks | Filter spesifik |
| **Database** | Full text search | Indexed columns |
| **User Input** | Text field | Various (date, select, etc) |

**Analogi:**
- `searchable()` = Ctrl+F pada halaman web
- `filters()` = Advanced search dengan kriteria spesifik

---

## L. Kesimpulan

Pada pertemuan ini mahasiswa telah mempelajari:

- **Search Implementation**: Menambahkan `searchable()` pada kolom untuk pencarian real-time
- **Date Filter**: Membuat `Filter` dengan `DatePicker` untuk filter berdasarkan tanggal
- **Select Filter**: Membuat `SelectFilter` untuk filter berdasarkan relasi
- **Custom Query**: Menambahkan query logic (`->query()`) untuk kontrol filter behavior
- **Combined Features**: Menggabungkan Search dan Filter secara bersamaan
