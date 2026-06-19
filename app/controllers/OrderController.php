<?php

require_once "../config/database.php";
require_once "../app/middleware/auth.php";

class OrderController
{
    // TAMPIL FORM ORDER
    public function create()
    {
        requireLogin();
        global $conn;

        if (!isset($_GET['id'])) {
            die("Product ID tidak ditemukan");
        }

        $productId = (int) $_GET['id'];

        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$productId");
        $product = mysqli_fetch_assoc($result);

        if (!$product) {
            die("Produk tidak ditemukan");
        }

        require "../app/views/customer/order_form.php";
    }


    // SIMPAN ORDER
    public function store()
    {
        requireLogin();
        global $conn;

        $userId = $_SESSION['user_id'];
        $productId = (int) $_POST['product_id'];
        $qty = (int) $_POST['quantity'];
        $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');

        $result = mysqli_query($conn, "SELECT price, stock FROM products WHERE id=$productId");
        $product = mysqli_fetch_assoc($result);

        if (!$product) {
            die("Produk tidak ditemukan");
        }

        if ($qty > $product['stock']) {
            die("Stok tidak cukup");
        }

        $total = $product['price'] * $qty;

        mysqli_query($conn, "
            INSERT INTO orders (user_id, product_id, quantity, total_price, address)
            VALUES ('$userId', '$productId', '$qty', '$total', '$address')
        ");

        mysqli_query($conn, "
            UPDATE products
            SET stock = stock - $qty
            WHERE id=$productId
        ");

        header("Location: index.php?url=order/myOrders");
        exit;
    }


    // LIHAT SEMUA ORDER (ADMIN)
    public function index()
    {
        requireLogin();
        global $conn;

        $result = mysqli_query($conn, "
            SELECT orders.*, users.name AS customer_name, products.name AS product_name
            FROM orders
            JOIN users ON users.id = orders.user_id
            JOIN products ON products.id = orders.product_id
            ORDER BY orders.id DESC
        ");

        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }

        require "../app/views/orders/index.php";
    }


    // LIHAT ORDER USER
    public function myOrders()
    {
        requireLogin();
        global $conn;

        $userId = $_SESSION['user_id'];

        $result = mysqli_query($conn, "
            SELECT orders.*, products.name AS product_name, products.price
            FROM orders
            JOIN products ON products.id = orders.product_id
            WHERE user_id = $userId
            ORDER BY orders.id DESC
        ");

        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }

        require "../app/views/customer/my_orders.php";
    }


    // UPDATE STATUS ORDER (ADMIN)
    public function updateStatus()
    {
        requireLogin();
        global $conn;

        $id = (int) $_POST['id'];
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        mysqli_query($conn, "
            UPDATE orders SET status = '$status' WHERE id = $id
        ");

        header("Location: index.php?url=order/index");
        exit;
    }
}