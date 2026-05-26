# Debugging Log — Cookies Shop

Catatan error yang ditemukan dan diperbaiki selama proses debugging.

---

## Error 1 — Form Login & Register Tidak Bisa Submit

### Gejala
Saat menekan tombol Login atau Register, browser menampilkan halaman **"URL not found"** dengan URL seperti:
```
http://cookiess_shop.test/cookies-shop/public/index.php?url=auth/processLogin
```

### Penyebab
Form action di tiga file view menggunakan **path absolut yang di-hardcode** sesuai nama folder lama (`cookies-shop`), padahal nama folder proyek adalah `cookiess_shop` dan dijalankan lewat virtual host Laragon (`cookiess_shop.test`).

Path yang salah:
```
/cookies-shop/public/index.php?url=auth/processLogin
/cookies-shop/public/index.php?url=auth/processRegister
/cookies-shop/public/index.php?url=product/store
```

Karena nama folder tidak cocok, Apache mencari folder `/cookies-shop/` yang tidak ada di server → **404 Not Found**.

### File yang Diubah

| File | Baris | Sebelum | Sesudah |
|------|-------|---------|---------|
| `app/views/auth/login.php` | 25 | `/cookies-shop/public/index.php?url=auth/processLogin` | `index.php?url=auth/processLogin` |
| `app/views/auth/login.php` | 69 | `/cookies-shop/public/index.php?url=auth/register` | `index.php?url=auth/register` |
| `app/views/auth/register.php` | 19 | `/cookies-shop/public/index.php?url=auth/processRegister` | `index.php?url=auth/processRegister` |
| `app/views/products/create.php` | 15 | `/cookies-shop/public/index.php?url=product/store` | `index.php?url=product/store` |

### Pelajaran
Jangan hardcode nama folder di dalam form action. Gunakan path relatif (`index.php?url=...`) supaya tidak rusak ketika nama folder berubah atau dijalankan di server yang berbeda.

---

## Error 2 — Dashboard Gagal Load Setelah Login

### Gejala
Login berhasil (sesi tersimpan, redirect ke dashboard), tapi langsung muncul fatal error:
```
Warning: require_once(../views/middleware/auth.php): Failed to open stream: No such file or directory
in D:\laragon\www\cookiess_shop\app\controllers\DashboardController.php on line 2

Fatal error: Uncaught Error: Failed opening required '../views/middleware/auth.php'
```

### Penyebab
`DashboardController.php` menggunakan path yang **salah dua kali**:

1. `require_once "../views/middleware/auth.php"` — folder `views` tidak punya subfolder `middleware`. File aslinya ada di `app/middleware/auth.php`.
2. `require_once "../app/views/dashboard/index.php"` — karena controller sudah berada di dalam folder `app/controllers/`, path `../app/` naik dulu ke root lalu turun ke `app/` lagi → path ganda yang tidak perlu (meskipun kebetulan tidak error di sini).

Path file `auth.php` yang benar dilihat dari posisi controller (`app/controllers/`):
```
../middleware/auth.php   ← naik satu level ke app/, lalu masuk middleware/
```

### File yang Diubah

| File | Baris | Sebelum | Sesudah |
|------|-------|---------|---------|
| `app/controllers/DashboardController.php` | 2 | `require_once "../views/middleware/auth.php"` | `require_once "../app/middleware/auth.php"` |

### Pelajaran
Saat menulis `require_once`, selalu hitung posisi file saat ini relatif terhadap file yang ingin di-include. Controller berada di `app/controllers/` — untuk mencapai `app/middleware/`, path-nya adalah `../middleware/`, bukan `../views/middleware/`.

---

## Ringkasan Semua Error

| No | Error | File | Jenis Masalah |
|----|-------|------|---------------|
| 1 | Form submit → 404 | `login.php`, `register.php`, `create.php` | Path hardcode salah nama folder |
| 2 | Dashboard fatal error | `DashboardController.php` | Path `require_once` menunjuk folder yang tidak ada |
