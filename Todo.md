# Todo — Cookies Shop (Next Steps)

Daftar fitur yang perlu dikerjakan selanjutnya. Kerjakan sesuai urutan karena setiap bagian bergantung pada bagian sebelumnya.

---

## Tahap 1 — Buat Tabel Orders di Database

Sebelum membuat fitur order, buat dulu tabel `orders` di database.

Jalankan query SQL ini di phpMyAdmin → tab **SQL**:

```sql
CREATE TABLE orders (
    id          INT PRIMARY KEY AUTO_INCREMENT,
    user_id     INT NOT NULL,
    product_id  INT NOT NULL,
    quantity    INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    address     TEXT NOT NULL,
    status      ENUM('pending', 'diproses', 'dikirim', 'selesai') DEFAULT 'pending',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)    REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);
```

Kolom yang ada:
| Kolom | Keterangan |
|-------|------------|
| `user_id` | ID user yang memesan |
| `product_id` | ID produk yang dibeli |
| `quantity` | Jumlah produk yang dibeli |
| `total_price` | Harga total (quantity × harga produk) |
| `address` | Alamat pengiriman |
| `status` | Status pesanan, default otomatis `pending` |

---

## Tahap 2 — Sistem 2 Role (Admin & User)

Saat ini semua halaman bisa diakses siapa saja setelah login. Perlu dibedakan antara admin dan user biasa.

### Yang perlu dikerjakan:

**A. Update middleware `app/middleware/auth.php`**

Tambahkan fungsi baru untuk cek role admin:

```php
function requireAdmin() {
    requireLogin();
    if ($_SESSION['role'] !== 'admin') {
        header("Location: index.php?url=user/dashboard");
        exit;
    }
}

function requireUser() {
    requireLogin();
    if ($_SESSION['role'] !== 'user') {
        header("Location: index.php?url=dashboard/index");
        exit;
    }
}
```

**B. Pasang middleware di controller yang sudah ada**

- `DashboardController::index()` → ganti `requireLogin()` dengan `requireAdmin()`
- `ProductController` semua method → ganti `requireLogin()` dengan `requireAdmin()`

---

## Tahap 3 — Fitur User: Beli Produk

### 3a. Buat `UserController.php` di `app/controllers/`

Method yang dibutuhkan:
- `dashboard()` — tampilkan katalog produk yang bisa dibeli
- `order($id)` — tampilkan form pesanan untuk produk tertentu
- `storeOrder()` — proses POST dari form pesanan, simpan ke tabel `orders`
- `myOrders()` — tampilkan daftar pesanan milik user yang sedang login

### 3b. Buat Model `app/models/Order.php`

Method yang dibutuhkan:
- `create($user_id, $product_id, $quantity, $total_price, $address)` — simpan order baru dengan status default `pending`
- `getByUser($user_id)` — ambil semua order milik user tertentu, JOIN dengan tabel `products` agar nama produk ikut tampil

### 3c. Buat View `app/views/user/`

Buat folder `app/views/user/` lalu buat file:

**`dashboard.php`** — Halaman katalog produk untuk user
- Tampilkan semua produk dalam bentuk kartu (card)
- Setiap kartu ada tombol **"Beli"** yang mengarah ke form pesanan

**`order_form.php`** — Form pemesanan
- Tampilkan nama produk dan harga yang dipilih
- Input: jumlah/quantity dan alamat pengiriman
- Total harga dihitung otomatis dari quantity × harga produk
- Tombol **"Pesan Sekarang"** → POST ke `user/storeOrder`
- Status otomatis `pending` saat disimpan (tidak perlu input dari user)

**`my_orders.php`** — Halaman pesanan saya
- Tampilkan tabel pesanan milik user yang login
- Kolom: No, Nama Produk, Jumlah, Total Harga, Alamat, Status, Tanggal Pesan
- Warnai kolom status sesuai kondisi:
  - `pending` → kuning
  - `diproses` → biru
  - `dikirim` → ungu
  - `selesai` → hijau

### 3d. Tambahkan Route

Di `public/index.php` routing sudah otomatis pakai nama controller, jadi cukup pastikan nama file dan class `UserController` sudah benar.

URL yang akan digunakan:
```
index.php?url=user/dashboard     → katalog produk
index.php?url=user/order&id=X    → form pesanan produk ID X
index.php?url=user/storeOrder    → proses POST form pesanan
index.php?url=user/myOrders      → halaman pesanan saya
```

---

## Tahap 4 — Fitur Admin: Kelola Order

### 4a. Tambahkan method di `OrderController.php`

Method yang dibutuhkan:
- `index()` — tampilkan semua order dari semua user, JOIN dengan `users` dan `products`
- `updateStatus()` — proses POST untuk ubah status order

### 4b. Update Model `app/models/Order.php`

Tambahkan method:
- `getAll()` — ambil semua order, JOIN nama user dan nama produk
- `updateStatus($id, $status)` — update kolom status berdasarkan ID order

### 4c. Buat View `app/views/orders/index.php`

Tampilkan tabel semua pesanan:
- Kolom: No, Nama User, Nama Produk, Jumlah, Total Harga, Alamat, Status, Aksi
- Kolom **Aksi**: dropdown atau tombol untuk ubah status
  - Pilihan: `pending` → `diproses` → `dikirim` → `selesai`
- Form ubah status kirim POST ke `order/updateStatus` dengan `id` dan `status` baru

### 4d. Tambahkan link Orders di sidebar admin

Di `app/views/dashboard/index.php` dan `app/views/products/index.php`, link Orders yang sekarang kosong (`href=""`) ganti dengan:
```html
href="index.php?url=order/index"
```

---

## Ringkasan Checklist

### Database
- [ ] Buat tabel `orders` dengan SQL di atas

### Middleware & Role
- [ ] Tambah fungsi `requireAdmin()` dan `requireUser()` di `auth.php`
- [ ] Pasang `requireAdmin()` di `DashboardController` dan `ProductController`

### Fitur User
- [ ] Buat `UserController.php` dengan method: `dashboard`, `order`, `storeOrder`, `myOrders`
- [ ] Buat `app/models/Order.php` dengan method: `create`, `getByUser`
- [ ] Buat view `app/views/user/dashboard.php` (katalog produk)
- [ ] Buat view `app/views/user/order_form.php` (form pesanan)
- [ ] Buat view `app/views/user/my_orders.php` (pesanan saya)

### Fitur Admin
- [ ] Tambah method `index()` dan `updateStatus()` di `OrderController.php`
- [ ] Tambah method `getAll()` dan `updateStatus()` di `Order.php` model
- [ ] Buat view `app/views/orders/index.php` (kelola semua order)
- [ ] Perbaiki link Orders di sidebar admin

---

## Catatan Penting

- Jangan lupa `requireAdmin()` di semua halaman admin dan `requireUser()` di semua halaman user — tanpa ini siapapun bisa akses semua halaman
- `total_price` dihitung di controller sebelum disimpan: `$total = $quantity * $product['price']`
- Status default `pending` sudah di-set di level database (kolom `DEFAULT 'pending'`), tidak perlu diisi manual di PHP
- Model `User` dan `Order` di `app/models/` masih kosong — isi sesuai kebutuhan
