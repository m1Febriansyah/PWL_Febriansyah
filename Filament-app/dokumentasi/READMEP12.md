# JOBSHEET PRAKTIKUM PERTEMUAN 12
## Implementasi Toggle Column pada Table Filament

**Mata Kuliah:** Pemrograman Web Lanjut  
**Pertemuan:** 12  
**Framework:** Filament

- Nama: Muhammad Febriansyah
- NIM: 244107020199
- Kelas: TI-2F
- Mata Kuliah: Pemrograman Web Lanjut

## A. Latar Belakang

Pada tabel Post sebelumnya, kita memiliki banyak kolom seperti:
- Image
- Title
- Slug
- Category
- Created At

Namun jika terlalu banyak kolom ditampilkan sekaligus, tabel menjadi penuh dan kurang rapi. Solusinya adalah menggunakan fitur **Toggle Column**, sehingga:

- Kolom bisa disembunyikan sementara
- User dapat memilih kolom mana yang ingin ditampilkan
- Preferensi tersimpan otomatis dalam session

---

## B. Konsep Toggle Column di Filament

### Tanpa Toggle Column
- Semua kolom selalu tampil
- Tampilan penuh dan membingungkan
- Tidak ada kontrol untuk user

### Dengan Toggle Column
- User bisa memilih kolom yang ingin dilihat
- Tampilan lebih rapi dan fleksibel
- Preferensi tersimpan secara otomatis
- User experience lebih baik

Fitur ini sangat berguna untuk sistem admin dengan banyak data dan kolom dinamis.

---

## C. Menambahkan Kolom Baru

### 1. Menambahkan Kolom ID

**File:** `PostResource.php`

**Tambahkan pada method `table()` di bagian `->columns()`:**
```php
TextColumn::make('id')
    ->label('ID'),
```

**Hasil:**
- Kolom ID tampil di tabel
- Menampilkan ID setiap post

---

### 2. Menambahkan Kolom Tags

**Tambahkan pada kolom:**
```php
TextColumn::make('tags')
    ->label('Tags'),
```

**Hasil:**
- Kolom Tags tampil di tabel
- Menampilkan tags untuk setiap post

---

### 3. Menambahkan Kolom Published (Boolean)

Untuk kolom boolean, gunakan **IconColumn** agar lebih visual.

**Tambahkan Import:**
```php
use Filament\Tables\Columns\IconColumn;
```

**Tambahkan pada kolom:**
```php
IconColumn::make('published')
    ->boolean()
    ->label('Published'),
```

**Penjelasan:**
- `IconColumn::make('published')` → Buat kolom dengan icon
- `->boolean()` → Format sebagai boolean 
- `->label('Published')` → Label kolom

**Hasil:**
- Kolom Published tampil dengan icon


**Screenshot:**
```
[Tambahkan Kolom Baru - Published Column dengan Icon]
```
(img/12-1.jpg)

---

## D. Mengaktifkan Toggle Column

Untuk membuat kolom bisa di-toggle, tambahkan method `->toggleable()` pada kolom yang ingin di-toggle.

### Sintaks Dasar:
```php
TextColumn::make('id')
    ->label('ID')
    ->toggleable(),
```

### Implementasi Lengkap:

**File:** `PostResource.php`

**Ubah semua kolom agar toggleable:**
```php
TextColumn::make('id')
    ->label('ID')
    ->toggleable(),

TextColumn::make('title')
    ->label('Title')
    ->toggleable(),

TextColumn::make('slug')
    ->label('Slug')
    ->toggleable(),

TextColumn::make('category.name')
    ->label('Category')
    ->toggleable(),

TextColumn::make('tags')
    ->label('Tags')
    ->toggleable(),

IconColumn::make('published')
    ->boolean()
    ->label('Published')
    ->toggleable(),

ImageColumn::make('image')
    ->label('Image')
    ->toggleable(),

TextColumn::make('created_at')
    ->label('Created At')
    ->toggleable(),
```

**Hasil:**
- Ikon pengaturan kolom muncul di kanan atas tabel
- User bisa mencentang atau menghilangkan kolom
- Klik tombol "Apply Columns" → Kolom langsung berubah

**Screenshot:**
```
[Toggle Column Menu - Showing Column Options]
```
(img/12-2.jpg)

**Screenshot:**
```
[Toggle Column Applied - Table dengan Some Columns Hidden]
```
(img/12-3.jpg)

---

## E. Menyembunyikan Kolom Secara Default

Jika ingin kolom tersembunyi saat pertama kali dibuka, gunakan parameter `isToggledHiddenByDefault: true`.

### Sintaks:
```php
->toggleable(isToggledHiddenByDefault: true)
```

### Implementasi:

```php
TextColumn::make('id')
    ->label('ID')
    ->toggleable(isToggledHiddenByDefault: true),

TextColumn::make('tags')
    ->label('Tags')
    ->toggleable(isToggledHiddenByDefault: true),

IconColumn::make('published')
    ->boolean()
    ->label('Published')
    ->toggleable(isToggledHiddenByDefault: true),
```

**Penjelasan:**
- Kolom ID, Tags, dan Published tersembunyi saat pertama kali
- User bisa mengaktifkannya melalui menu toggle

**Hasil:**
- Tabel tampil lebih sederhana saat pertama kali
- Kolom yang tersembunyi default tidak tampil
- User dapat mengaktifkan via menu toggle

**Screenshot:**
```
[Default Hidden Columns - Table without ID, Tags, Published]
```
(img/12-4.jpg)

**Screenshot:**
```
[Toggle Menu - Showing Hidden Columns Available]
```
(img/12-5.jpg)

---

## F. Penyimpanan Preferensi Kolom (Session)

Filament otomatis menyimpan preferensi kolom user dalam **session**. Ini berarti:

- Kolom yang diaktifkan/disembunyikan user tersimpan
- Saat pindah halaman lalu kembali, konfigurasi tetap tersimpan
- Preferensi tersimpan selama session aktif (sampai user logout)

**Cara Kerja:**
1. User mencentang/menghilangkan kolom
2. Klik "Apply Columns"
3. Filament menyimpan ke session
4. User navigasi ke halaman lain
5. Kembali ke tabel → Konfigurasi sama seperti sebelumnya

**Screenshot:**
```
[Session Persistence - Kolom Tetap Hidden Setelah Navigasi]
```
(img/12-6.jpg)

---

## H. Penjelasan Method Toggle Column

### Method `->toggleable()`
- Membuat kolom bisa di-toggle (disembunyikan/ditampilkan)
- Kolom tampil secara default
- User bisa mengubah visibility

### Method `->toggleable(isToggledHiddenByDefault: true)`
- Membuat kolom bisa di-toggle
- Kolom **tersembunyi** secara default
- User bisa mengaktifkannya dari menu

### Kapan Gunakan Parameter `isToggledHiddenByDefault: true`?
- Untuk kolom yang jarang digunakan (ID, Internal Keys)
- Untuk kolom tambahan yang bersifat opsional
- Untuk menjaga tampilan awal tetap rapi dan fokus

---

## J. Latihan Praktikum

### Tugas:

1. **Aktifkan toggleable pada semua kolom**
   - Minimal 8 kolom (ID, Title, Slug, Category, Color, Image, Tags, Created At, Published)
   - Setiap kolom harus memiliki `->toggleable()`

2. **Sembunyikan minimal 2 kolom secara default**
   - Gunakan `isToggledHiddenByDefault: true` untuk minimal 2 kolom
   - Contoh: ID, Tags

3. **Uji penyimpanan preferensi**
   - Toggle beberapa kolom (hide dan show)
   - Navigasi ke halaman lain
   - Kembali ke tabel Posts
   - Verifikasi bahwa preferensi tetap tersimpan

4. **Dokumentasi dengan Screenshot:**
   - Screenshot 1: Tampilan awal tabel (sebelum toggle)
    (img/12-4.jpg)
   - Screenshot 2: Menu toggle kolom terbuka
    (img/12-5.jpg)
   - Screenshot 3: Tampilan setelah beberapa kolom disembunyikan
    (img/12-6.jpg)

---

## K. Analisis & Diskusi

### Pertanyaan:

1. **Mengapa toggle column penting pada admin panel?**
   - Jawab: Agar user bisa fokus pada kolom yang relevan, mengurangi information overload

2. **Apa perbedaan `toggleable()` dengan `isToggledHiddenByDefault: true`?**
   - Jawab: 
     - `toggleable()` → Kolom tampil default, bisa disembunyikan
     - `isToggledHiddenByDefault: true` → Kolom tersembunyi default, bisa ditampilkan

3. **Mengapa preferensi kolom tetap tersimpan saat pindah halaman?**
   - Jawab: Karena Filament menyimpan ke session (server-side), bukan local storage

4. **Kapan sebaiknya kolom disembunyikan secara default?**
   - Jawab: 
     - Untuk kolom dengan value unik (ID)
     - Untuk kolom internal/system (timestamps khusus)
     - Untuk kolom tambahan yang jarang digunakan

5. **Apakah preferensi kolom tersimpan setelah logout?**
   - Jawab: Tidak, karena disimpan dalam session yang terhapus saat logout
