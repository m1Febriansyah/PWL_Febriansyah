# Dokumentasi Jobsheet Pertemuan 15

Dokumentasi ini berisi rangkuman Jobsheet Pertemuan 15 pada project Filament App. Materi mencakup implementasi relasi Many-to-Many (BelongsToMany) pada Laravel, penggunaan Select dengan multiple pada form Filament, implementasi dropdown relationship yang dapat memilih multiple tags, serta pembuatan Relationship Manager untuk mengelola data relasi tags langsung dari Filament Admin Panel.

- Nama: Muhammad Febriansyah
- NIM: 244107020199
- Kelas: TI-2F
- Mata Kuliah: Pemrograman Web Lanjut

## Struktur Materi

---

## Jobsheet 15 - Implementasi Relationship Many-to-Many pada Filament (BelongsToMany)

Pada tahap ini dipelajari cara membuat dan mengelola relationship Many-to-Many antara model Post dan Tag menggunakan fitur-fitur Filament untuk meningkatkan efisiensi CRUD data tags dengan multiple selection.

### Langkah-Langkah Implementasi

#### 1. Relasi Post dan Tag pada Database

Struktur database untuk relasi Many-to-Many:

**Tabel Posts:**
```
id
title
slug
category_id (foreign key)
color
image
body
published
published_at
created_at
updated_at
```

**Tabel Tags:**
```
id
name
created_at
updated_at
```

**Tabel Pivot (post_tag):**
```
id
post_id (foreign key)
tag_id (foreign key)
created_at
updated_at
```

**Relasi:**
- **Post** → `BelongsToMany` → **Tag**
- **Tag** → `BelongsToMany` → **Post**

---

#### 2. Implementasi Relationship pada Model

Tambahkan method relationship pada model Post:

**File: app/Models/Post.php**
```php
public function tags()
{
    return $this->belongsToMany(Tag::class, 'post_tag');
}
```

Tambahkan method relationship pada model Tag:

**File: app/Models/Tag.php**
```php
public function posts()
{
    return $this->belongsToMany(Post::class, 'post_tag');
}
```

**Penjelasan Parameter:**
- **`Tag::class`** - Model yang berelasi dengan Post
- **`'post_tag'`** - Nama tabel pivot yang menghubungkan kedua model

---

#### 3. Membuat Tabel Pivot

Buat migration untuk tabel pivot:

```bash
php artisan make:migration create_post_tag_table
```

**File: database/migrations/XXXX_XX_XX_create_post_tag_table.php**
```php
public function up(): void
{
    Schema::create('post_tag', function (Blueprint $table) {
        $table->id();
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        $table->foreignId('tag_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('post_tag');
}
```

Jalankan migration:
```bash
php artisan migrate
```

---

#### 4. Implementasi Multiple Select pada Form Filament

Ganti TagsInput dengan Select yang menggunakan relationship untuk multiple selection:

**File: app/Filament/Admin/Resources/PostResource.php**
```php
Select::make("tags")
    ->relationship('tags', 'name')
    ->multiple(),
```

**Penjelasan Parameter:**
- **`'tags'`** - Nama relasi pada model Post
- **`'name'`** - Field yang ditampilkan pada dropdown
- **`->multiple()`** - Memungkinkan pemilihan multiple tags

**Hasil Form:**
[Multiple Select Tags](img/15-1.jpg)

---

#### 5. Menampilkan Multiple Tags pada Tabel

Tampilkan tags pada Post Table dengan formatting yang sesuai:

**File: app/Filament/Admin/Resources/PostResource.php**
```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('title')
                ->sortable()
                ->searchable(),
            TextColumn::make('tags')
                ->label('Tags')
                ->toggleable(isToggledHiddenByDefault: true),
            // kolom lainnya
        ])
}
```

**Hasil:**
Menampilkan semua tags yang terkait dengan post dalam format array atau string.

[Tabel dengan Tags Column](img/15-2.jpg)

---

#### 6. Membuat Relationship Manager untuk Tags

Relationship Manager memungkinkan mengelola tags langsung dari resource Post tanpa perlu berpindah halaman.

**Jalankan Command:**
```bash
php artisan make:filament-relation-manager PostResource tags name
```

**Parameter:**
- **`PostResource`** - Resource tempat relation manager ditambahkan
- **`tags`** - Nama relasi pada model Post
- **`name`** - Kolom yang ditampilkan sebagai title

**File yang Dibuat:**
```
PostResource/RelationManagers/
└── TagsRelationManager.php
```

---

#### 7. Konfigurasi Relationship Manager

**File: app/Filament/Admin/Resources/PostResource/RelationManagers/TagsRelationManager.php**

Struktur dasar Relationship Manager:

```php
<?php

namespace App\Filament\Admin\Resources\PostResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TagsRelationManager extends RelationManager
{
    protected static string $relationship = 'tags';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
```

**Penjelasan Konfigurasi:**
- **`protected static string $relationship = 'tags'`** - Menetapkan relasi yang dikelola
- **`->recordTitleAttribute('name')`** - Field yang ditampilkan sebagai judul record
- **`CreateAction`** - Menambah tag baru
- **`EditAction`** - Mengedit tag yang sudah ada
- **`DeleteAction`** - Menghapus tag
- **`DetachBulkAction`** - Melepas hubungan tag dari post (bulk)
- **`DeleteBulkAction`** - Menghapus tag yang dipilih

[Relationship Manager Tags](img/15-3.jpg)

---

#### 8. Mengintegrasikan Relationship Manager ke Resource

**File: app/Filament/Admin/Resources/PostResource.php**

Tambahkan method getRelations() pada class PostResource:

```php
public static function getRelations(): array
{
    return [
        TagsRelationManager::class,
    ];
}
```

Atau tambahkan di bagian relation managers:

```php
use App\Filament\Admin\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    // ...
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\TagsRelationManager::class,
        ];
    }
}
```

---

## Analisis dan Diskusi

### 1. Perbedaan Select dengan Relationship vs TagsInput

**TagsInput:**
- Menyimpan tags dalam format array/JSON
- Tidak membuat relasi di database
- Cocok untuk custom values yang tidak terstruktur
- Data disimpan dalam satu kolom

**Select dengan Relationship:**
- Membuat relasi Many-to-Many di database
- Reusable data (tag bisa digunakan di multiple posts)
- Data terstruktur dan terpusat
- Queries lebih efisien dengan join

### 2. Keuntungan Menggunakan Many-to-Many Relationship

1. **Data Integrity**: Data tags terpusat dan tidak duplikat
2. **Query Efficiency**: Bisa melakukan filter dan search tags dengan mudah
3. **Reusability**: Satu tag bisa digunakan di banyak posts
4. **Maintainability**: Update tag di satu tempat, semua posts otomatis terupdate
5. **Relationship Manager**: Mengelola tags langsung dari Post detail page

### 3. Kasus Penggunaan

**Gunakan Many-to-Many ketika:**
- Tags/categories bersifat reusable
- Ingin centralized tag management
- Butuh tracking history atau metadata tag
- Multiple records bisa share tag yang sama

**Gunakan TagsInput ketika:**
- Tags bersifat unique per record
- Tidak perlu tracking relasi
- Tags dinamis dan tidak terstruktur
- Performance lebih penting dari structure

### 4. Performance Considerations

**Many-to-Many:**
- Memerlukan JOIN query (lebih kompleks)
- Overhead tabel pivot
- Cocok untuk volume tag moderate

**TagsInput (Array):**
- Query lebih simple
- Searching tags lebih sulit (LIKE pada JSON)
- Cocok untuk volume tag banyak

### 5. Best Practices

1. **Naming Convention**: Gunakan nama relasi yang deskriptif (`tags`, bukan `t`)
2. **Eager Loading**: Gunakan `with('tags')` di queries untuk optimize performance
3. **Validation**: Validasi tag_id pada form submission
4. **Soft Delete**: Pertimbangkan soft delete untuk tags management
5. **Caching**: Cache popular tags untuk optimize performance

---

## Kesimpulan

Pertemuan 15 memperkenalkan implementasi relationship Many-to-Many pada Laravel dan Filament, memberikan alternatif yang lebih powerful dibanding TagsInput untuk kasus di mana data tags perlu terstruktur dan reusable. Dengan Relationship Manager, pengelolaan tags menjadi lebih intuitif langsung dari Post detail page.

Fitur ini sangat berguna untuk aplikasi yang memerlukan kategorisasi flexible dan centralized tag management seperti blog platform, e-commerce, dan social media applications.
