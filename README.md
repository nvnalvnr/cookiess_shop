# Cookies Shop — Project Documentation

## Overview

PHP MVC web app for a cookie store. Supports admin product management and customer ordering (customer side partially implemented). Built with vanilla PHP, MySQLi, and Tailwind CSS (CDN).

---

## Tech Stack

| Layer      | Tech                        |
|------------|-----------------------------|
| Language   | PHP 8.3.30 (no framework)   |
| Database   | MySQL 8.4.3 via `mysqli_*`  |
| Styling    | Tailwind CSS (CDN)          |
| Server     | Apache/Laragon (localhost)  |

---

## Project Structure

```
cookiess_shop/
├── public/
│   └── index.php              # Front controller (entry point)
├── config/
│   └── database.php           # DB connection
├── database/
│   └── cookiess_shop.sql      # Full DB dump (schema + seed data)
├── app/
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── ProductController.php
│   │   └── OrderController.php    # Empty — not implemented
│   ├── models/
│   │   ├── product.php            # Product::getAll()
│   │   ├── user.php               # Empty
│   │   └── order.php              # Empty
│   └── views/
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── dashboard/
│       │   └── index.php
│       ├── layouts/               # Added — all currently empty
│       │   ├── header.php
│       │   ├── sidebar.php
│       │   └── footer.php
│       ├── products/
│       │   ├── index.php          # Product list table
│       │   ├── create.php         # Add product form
│       │   └── edit.php           # Empty — not implemented
│       ├── customer/
│       │   ├── catalog.php        # Empty — not implemented
│       │   ├── order_form.php     # Empty — not implemented
│       │   └── my_orders.php      # Empty — not implemented
│       └── middleware/
│           └── auth.php           # Empty — not implemented
```

---

## Routing

Handled by `public/index.php`. Uses query string `?url=controller/method`.

```
?url=auth/login          → AuthController::login()
?url=auth/processLogin   → AuthController::processLogin()
?url=auth/register       → AuthController::register()
?url=auth/processRegister→ AuthController::processRegister()
?url=dashboard/index     → DashboardController::index()
?url=product/index       → ProductController::index()
?url=product/create      → ProductController::create()
?url=product/store       → ProductController::store()
```

Routing logic: splits URL by `/`, capitalizes first segment + appends `Controller`, calls second segment as method.

---

## Database

**Config:** `config/database.php`

```
Host: localhost
User: root
Pass: (empty)
DB:   cookiess_shop
```

SQL dump located at `database/cookiess_shop.sql`. Import this to set up the DB.

### Tables

#### `users`
| Column     | Type                    | Notes                        |
|------------|-------------------------|------------------------------|
| id         | INT PK AI               |                              |
| name       | VARCHAR(100)            |                              |
| email      | VARCHAR(100) UNIQUE     | Used for login               |
| password   | VARCHAR(255)            | bcrypt via `password_hash()` |
| role       | ENUM('admin','user')    | Default: `user`              |
| created_at | TIMESTAMP               | Default: CURRENT_TIMESTAMP   |

> Seed data: 1 user included in dump (role: `user`).

#### `products`
| Column     | Type          | Notes                      |
|------------|---------------|----------------------------|
| id         | INT PK AI     |                            |
| name       | VARCHAR(100)  |                            |
| price      | DECIMAL(10,2) |                            |
| stock      | INT           |                            |
| created_at | TIMESTAMP     | Default: CURRENT_TIMESTAMP |

> No `orders` table exists yet — `OrderController` and `order.php` model are empty.

---

## Controllers

### AuthController
- `login()` — renders login view
- `processLogin()` — POST: validates email+password, sets `$_SESSION['user_id']`, `['name']`, `['role']`, redirects to dashboard
- `register()` — renders register view
- `processRegister()` — POST: hashes password with `password_hash()`, inserts new user (default role: customer implied)

### DashboardController
- `index()` — renders admin dashboard view (stats are **hardcoded**, not from DB)

### ProductController
- `index()` — fetches all products via `Product::getAll()`, renders product list
- `create()` — renders add-product form
- `store()` — POST: validates name/price/stock, calls `Product::create()`, redirects to product list

### OrderController
- **Empty.** No methods implemented.

---

## Models

### Product (`app/models/product.php`)
- `__construct($conn)` — stores DB connection
- `getAll()` — `SELECT * FROM products`, returns mysqli result

### User, Order
- **Both empty files.**

---

## Views

### Auth
- `login.php` — email + password form, orange-themed, links to register
- `register.php` — name + email + password form

### Dashboard (`dashboard/index.php`)
- Sidebar with links: Dashboard, Products, Orders (href="#"), Logout (href="#")
- Stats cards: Total Produk (hardcoded 20), Total Order (hardcoded 15), Total User (hardcoded 5)
- Shows `$_SESSION['name']` as welcome message

### Products
- `index.php` — table with ID, Nama, Harga (formatted as Rp), Stok, Aksi (Edit/Hapus buttons — **not wired**)
- `create.php` — form for name, price, stock → POST to `product/store`
- `edit.php` — **empty**

### Customer
- `catalog.php`, `order_form.php`, `my_orders.php` — **all empty**

---

## Session

Set on successful login:

```php
$_SESSION['user_id'] = $user['id'];
$_SESSION['name']    = $user['name'];
$_SESSION['role']    = $user['role'];
```

No middleware protects routes — `auth.php` middleware file exists but is empty.

---

## Known Issues & Incomplete Features

| Issue | Location | Severity |
|-------|----------|----------|
| SQL injection — raw `$email` in query string | `AuthController::processLogin()` line 28 | **Critical** |
| SQL injection — raw vars in INSERT | `AuthController::processRegister()` line 83 | **Critical** |
| No route protection — any URL accessible without login | `auth.php` middleware empty | High |
| Dashboard stats hardcoded | `dashboard/index.php` | Medium |
| Edit/Hapus buttons not wired | `products/index.php` | Medium |
| `Product::create()` called but not defined in model | `ProductController::store()` | High |
| Customer views all empty | `customer/` folder | High |
| `OrderController` empty | `OrderController.php` | High |
| `user.php`, `order.php` models empty | `models/` | High |
| Logout link is `href="#"` | `dashboard/index.php` | Medium |

---

## How to Run

### Requirements

- [Laragon](https://laragon.org/) (includes Apache + MySQL + PHP)
- PHP 8.0+
- MySQL 8.0+
- Browser

---

### Step 1 — Clone / place project

Put project folder inside Laragon's `www` directory:

```
C:\laragon\www\cookies-shop\
```

> Folder name **must be** `cookies-shop` — view form actions are hardcoded to `/cookies-shop/public/...`. If you use a different name, update all `action="..."` attributes in:
> - `app/views/auth/login.php`
> - `app/views/auth/register.php`
> - `app/views/products/create.php`

---

### Step 2 — Start Laragon

Open Laragon → click **Start All**.

Verify Apache and MySQL show green/running.

---

### Step 3 — Create the database

**Option A — phpMyAdmin (GUI)**

1. Open `http://localhost/phpmyadmin`
2. Click **New** → name it `cookiess_shop` → click **Create**
3. Select `cookiess_shop` database → go to **Import** tab
4. Choose file: `database/cookiess_shop.sql` → click **Go**

**Option B — CLI**

```bash
mysql -u root -e "CREATE DATABASE cookiess_shop;"
mysql -u root cookiess_shop < database/cookiess_shop.sql
```

---

### Step 4 — Verify DB config

Open `config/database.php` and confirm credentials match your Laragon setup:

```php
$host = "localhost";
$user = "root";
$pass = "";          // Laragon default: empty password
$db   = "cookiess_shop";
```

---

### Step 5 — Open in browser

```
http://localhost/cookies-shop/public/index.php?url=auth/login
```

You should see the Cookies Shop login page.

---

### Step 6 — Login or Register

**Register new account:**
Go to `http://localhost/cookies-shop/public/index.php?url=auth/register`
Fill in name, email, password → submit.

**Or use seeded account from SQL dump:**
> Check `database/cookiess_shop.sql` for the seeded user's email. Password is hashed — you need to register a new account or manually set a known password hash.

After login → redirected to `http://localhost/cookies-shop/public/index.php?url=dashboard/index`

---

### Page URLs

| Page            | URL                                                                 |
|-----------------|---------------------------------------------------------------------|
| Login           | `index.php?url=auth/login`                                          |
| Register        | `index.php?url=auth/register`                                       |
| Dashboard       | `index.php?url=dashboard/index`                                     |
| Product List    | `index.php?url=product/index`                                       |
| Add Product     | `index.php?url=product/create`                                      |

All URLs are relative to `http://localhost/cookies-shop/public/`.

---

### Troubleshooting

| Problem | Fix |
|---------|-----|
| Blank page / 404 | Check folder name is `cookies-shop` inside `www/` |
| "Koneksi database gagal" | MySQL not running, or DB name wrong in `config/database.php` |
| Form submits but nothing happens | Check folder name matches hardcoded `/cookies-shop/` in action URLs |
| Login fails with correct password | User may not exist — register first |
| Class not found error | Check URL segment matches controller filename exactly (case-sensitive on Linux) |

---

## What Works

- User registration (stores hashed password)
- User login (verifies hash, sets session)
- Product list (reads from DB, displays table)
- Add product form + store to DB
- Admin dashboard UI (static)

## What Doesn't Work Yet

- Edit product
- Delete product
- Logout
- Auth middleware / route protection
- All customer-facing pages (catalog, order form, my orders)
- Order system end-to-end
- Dynamic dashboard stats
