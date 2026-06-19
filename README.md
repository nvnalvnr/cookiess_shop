# Cookiess Shop

Aplikasi toko cookies sederhana — PHP MVC murni (gak pakai framework, gak pakai Composer/npm). Koneksi DB pakai `mysqli` langsung. Tailwind lewat CDN di view, gak ada build step. Jalan di Laragon (Apache + MySQL).

## Cara jalanin

1. Import `config/database/cookiess_shop.sql` ke MySQL, nama DB `cookiess_shop`.
2. `config/database.php` konek ke `localhost`, user `root`, password kosong.
3. Document root Apache/Laragon harus nunjuk ke folder `public/`, bukan root project.
4. Akses lewat `index.php?url=Controller/method`, contoh: `index.php?url=auth/login`.

## Catatan Bug & Perbaikan

Catatan ini dibuat biar tau letak kesalahan yang pernah kejadian dan gimana cara benerinnya — biar gak keulang pas ngembangin fitur baru.

### 1. Front controller `public/index.php` hilang

**Salah:** Commit `956085e` ("antara folder yang kehapus atau salah masukin file kedalam folder") gak sengaja menghapus `public/index.php` (router utama) dan menimpa `config/public/index.php` dengan file `app/views/products/index.php` (view tabel produk, bukan router). Akibatnya seluruh app gak bisa diakses — semua request lewat `?url=...` butuh router ini.

**Benerin:**
- `public/index.php` dibuat ulang isinya dispatcher: baca `?url=Controller/method`, require controller, panggil method.
- `config/public/index.php` (isinya view produk yang nyasar) dipindah balik ke `app/views/products/index.php`.
- Folder `config/public/` yang udah kosong dihapus.

### 2. Document root Laragon nunjuk ke folder salah

**Salah:** Vhost Apache nunjuk ke root project, bukan ke `public/`, jadi buka domain malah nampilin daftar folder (`Index of /`).

**Benerin:** Edit `DocumentRoot` dan `<Directory>` di auto-vhost conf jadi nunjuk ke `.../public/`.

### 3. `OrderController::store()` redirect ke route yang gak ada

**Salah:** Setelah checkout, redirect ke `index.php?url=customer/my-orders` → ini coba panggil `CustomerController` yang gak ada. Yang ada adalah `OrderController::myOrders()`.

**Benerin:** Redirect diganti ke `index.php?url=order/myOrders`.

### 4. Dashboard admin — variabel di view gak match sama yang dikirim controller

**Salah:** `DashboardController::index()` versi awal cuma compute `$totalProduk`, `$totalOrder` (singular), `$totalIncome`, dan `$recentOrders` (tanpa join `users`). Tapi `app/views/dashboard/index.php` butuh `$totalOrders` (plural), `$totalUser`, `$totalPending`, `$totalRevenue`, `$latestProducts`, dan `$row['customer_name']`. Semua itu gak pernah di-set di controller → banyak `Undefined variable` / `Undefined array key`.

**Benerin:** Controller diisi lengkap — query total user, total orders, total pending, total revenue (filter `status='completed'`), ambil `$latestProducts` dari `Product::getLatestProducts()`, dan query `$recentOrders` di-join juga ke tabel `users` biar ada `customer_name`.

### 5. Tombol "Pesan Sekarang" → "method tidak ditemukan"

**Salah (beberapa bug numpuk di `OrderController.php`):**
- Link di `catalog.php` panggil `order/create`, tapi controller cuma punya method `form()` — nama beda, jadinya 404/"method tidak ditemukan".
- Parameter juga beda: `catalog.php` kirim `?id=...`, method baca `$_GET['product_id']`.
- `store()` & `myOrders()` baca session pakai `$_SESSION['user']['id']` (nested), padahal `AuthController` nyimpennya flat `$_SESSION['user_id']`.
- `store()` redirect ke path langsung `/my-orders`, gak sesuai konvensi routing app ini (`index.php?url=...`).
- Method `index()` (buat admin lihat semua order) dan `updateStatus()` gak ada sama sekali, padahal dipanggil dari `sidebar.php` dan `orders/index.php`.
- Form order ngumpulin field alamat dan controller insert ke kolom `address`, tapi tabel `orders` di database belum punya kolom itu → query insert bakal gagal.

**Benerin:**
- Method `form()` diganti nama jadi `create()`, baca `$_GET['id']` (match sama link di `catalog.php`).
- Semua pemakaian session diseragamkan jadi `$_SESSION['user_id']`.
- Redirect diseragamkan jadi format `index.php?url=...`.
- Tambah method `index()` (list semua order + join `users`/`products` buat admin) dan `updateStatus()` (ubah status order).
- Field alamat tetap ada di form, setelah kolom `address` ditambahin ke tabel `orders`, query `INSERT` di `store()` juga udah diupdate buat nyimpen alamatnya.

### 6. `Class "Product" not found` di Dashboard

**Salah:** Pas nulis ulang `DashboardController.php`, baris `require_once "../app/models/Product.php";` di atas `class DashboardController` gak ikut disalin. Jadinya class `Product` gak ke-load sebelum dipakai.

**Benerin:** Pastikan 4 baris `require_once` ini selalu ada di paling atas file, sebelum `class DashboardController {`:
```php
require_once "../config/database.php";
require_once "../app/middleware/auth.php";
require_once "../app/models/Product.php";
require_once "../app/models/Order.php";
```

### 7. `Unknown column 'u' in 'field list'`

**Salah:** Query JOIN pakai alias `u.name`/`u.id` di `SELECT`/`ON`, tapi lupa kasih alias `u` pas nulis `JOIN users` (cuma nulis `JOIN users` tanpa `u` di belakangnya).

**Benerin:** Pastikan alias konsisten di semua bagian query:
```sql
SELECT o.*, p.name AS product_name, u.name AS customer_name
FROM orders o
JOIN products p ON p.id = o.product_id
JOIN users u ON u.id = o.user_id
ORDER BY o.id DESC
LIMIT 5
```

### 8. Revenue di dashboard 0, padahal udah ada order

**Bukan bug** — `$totalRevenue` cuma hitung order yang `status = 'completed'`. Order baru defaultnya `pending`, jadi gak ikut terhitung sampai status-nya diubah jadi "Selesai" lewat halaman admin "Kelola Pesanan" (`order/updateStatus`).

## Catatan tambahan (belum dibenerin, FYI aja)

- Model class filename lowercase (`product.php`) tapi di-require pakai huruf besar (`Product.php`) di banyak controller — kebetulan jalan karena Windows filesystem case-insensitive, bakal error kalau pindah ke server Linux.
- Query SQL di semua model/controller masih interpolasi langsung (gak prepared statement) — rawan SQL injection, perlu dibenahi sebelum deploy production.
- `routes/web.php` kosong dan gak dipakai, semua routing masih manual lewat `?url=` convention di `public/index.php`.
