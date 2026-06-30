# GreenShop - Sustainable Application Development

## 1. Deskripsi Project

GreenShop merupakan aplikasi katalog produk berbasis Laravel 12 yang dikembangkan untuk menerapkan prinsip Sustainable Application Development. Aplikasi ini mengelola data produk dan kategori serta menerapkan beberapa teknik optimasi untuk mengurangi penggunaan resource server.

Optimasi yang diterapkan:

* Eager Loading
* Caching
* Database Indexing
* Efficient Data Transfer (Select)
* Pagination

---

# 2. Teknologi yang Digunakan

* Laravel 12
* PHP 8.x
* MySQL
* MySQL Workbench
* Laravel Debugbar
* Bootstrap 5

---

# 3. Struktur Database

## Tabel Categories

| Field | Tipe    |
| ----- | ------- |
| id    | bigint  |
| name  | varchar |

## Tabel Products

| Field       | Tipe    |
| ----------- | ------- |
| id          | bigint  |
| category_id | bigint  |
| name        | varchar |
| price       | decimal |
| stock       | integer |

## Relasi

* Category hasMany Products
* Product belongsTo Category

---

# 4. Cara Menjalankan Project

## Install Dependency

```bash
composer install
```

## Copy Environment

```bash
copy .env.example .env
```

## Generate Key

```bash
php artisan key:generate
```

## Konfigurasi Database

Edit file .env

```env
DB_DATABASE=greenshop
DB_USERNAME=root
DB_PASSWORD=
```

## Migrasi dan Seeder

```bash
php artisan migrate:fresh --seed
```

## Menjalankan Server

```bash
php artisan serve
```

Akses:

```text
http://127.0.0.1:8000/products
```

---

# 5. Soal 1 - Baseline (Versi Boros)

## Implementasi

Controller menggunakan:

```php
$products = Product::all();
```

Pada view:

```php
{{ $product->category->name }}
```

Implementasi tersebut menyebabkan N+1 Query Problem.

## Hasil Pengujian

Jumlah Query : 103

Response Time : 1.99 s

Data Transfer : Tinggi

## Screenshot Debugbar

[MASUKKAN SCREENSHOT SOAL 1 DI SINI]

---

# 6. Soal 2 - Eager Loading

## Implementasi

```php
$products = Product::with('category')->get();
```

## Hasil Pengujian

Jumlah Query : 6

Response Time : 1.68 s

Data Transfer : Sedang

## Analisis

Penerapan eager loading berhasil menghilangkan N+1 Query Problem sehingga jumlah query turun drastis dari 103 query menjadi 6 query.

## Screenshot Debugbar

[MASUKKAN SCREENSHOT SOAL 2 DI SINI]

---

# 7. Soal 3 - Caching

## Implementasi

```php
Cache::remember('products_list',3600,function(){
    return Product::with('category')->get();
});
```

## Invalidasi Cache

```php
Cache::forget('products_list');
```

## Hasil Pengujian

Jumlah Query : 3

Response Time : 672 ms

Data Transfer : Rendah

## Analisis

Data berhasil diambil dari cache sehingga query ke tabel products dan categories tidak dijalankan kembali pada request berikutnya.

## Screenshot Debugbar

[MASUKKAN SCREENSHOT SOAL 3 DI SINI]

---

# 8. Soal 4 - Database Indexing & Efficient Data Transfer

## Database Indexing

```php
$table->index('category_id');
```

## Efficient Data Transfer

```php
Product::select(
    'id',
    'category_id',
    'name',
    'price',
    'stock'
)
```

## Pagination

```php
->paginate(10);
```

## Hasil

* Data ditampilkan 10 produk per halaman
* Transfer data lebih kecil
* Query filtering lebih cepat
* Beban database lebih ringan

## Screenshot Halaman Pagination

[MASUKKAN SCREENSHOT SOAL 4 DI SINI]

---

# 9. Tabel Perbandingan Hasil Optimasi

| Versi                       | Jumlah Query | Response Time | Data Transfer |
| --------------------------- | ------------ | ------------- | ------------- |
| Baseline (Boros)            | 103          | 1.99 s        | Tinggi        |
| Eager Loading               | 6            | 1.68 s        | Sedang        |
| Caching (Request ke-2)      | 3            | 672 ms        | Rendah        |
| Index + Select + Pagination | 3-6          | Lebih Cepat   | Rendah        |

---

# 10. Analisis Sustainability

Pada versi awal aplikasi GreenShop, halaman katalog mengalami masalah N+1 Query sehingga menghasilkan 103 query database untuk menampilkan data produk dan kategori. Kondisi ini menyebabkan response time menjadi lebih lambat dan penggunaan resource server menjadi lebih tinggi. Setelah diterapkan Eager Loading menggunakan with('category'), jumlah query berkurang secara signifikan menjadi 6 query. Selanjutnya, implementasi caching dengan Cache::remember() memungkinkan data disimpan sementara sehingga request berikutnya tidak perlu mengakses database secara berulang. Selain itu, penggunaan indexing, select statement, dan pagination membantu mengurangi beban query serta jumlah data yang ditransfer. Optimasi tersebut menghasilkan response time yang lebih cepat dan penggunaan CPU yang lebih efisien. Dengan berkurangnya aktivitas database dan pemrosesan server, konsumsi energi juga menjadi lebih rendah. Oleh karena itu, penerapan optimasi ini mendukung prinsip Sustainable Application Development karena aplikasi menjadi lebih hemat resource, scalable, dan ramah lingkungan.

---

# 11. EER Diagram Database

## Diagram Relasi

Categories (1) ---- (N) Products

## Screenshot EER Diagram

[MASUKKAN SCREENSHOT EER DIAGRAM MYSQL WORKBENCH DI SINI]

---

# 12. Kesimpulan

Penerapan Eager Loading, Caching, Database Indexing, Select Statement, dan Pagination berhasil meningkatkan performa aplikasi GreenShop secara signifikan. Jumlah query berhasil dikurangi dari 103 query menjadi 3 query pada implementasi caching. Optimasi tersebut mengurangi beban database, mempercepat response time, dan mendukung prinsip Sustainable Application Development karena penggunaan resource server menjadi lebih efisien.
