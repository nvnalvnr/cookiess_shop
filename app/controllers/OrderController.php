<?php

class OrderController
{
    // TAMPIL FORM ORDER
    public function form()
    {
        requireLogin();
        global $conn;

        if (!isset($_GET['product_id'])) {
            die("Product ID tidak ditemukan");
        }

        $productId = (int) $_GET['product_id'];

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

        $userId = $_SESSION['user']['id'];
        $productId = (int) $_POST['product_id'];
        $qty = (int) $_POST['quantity'];
        $address = mysqli_real_escape_string($conn, $_POST['address']);

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

        header("Location: /my-orders");
        exit;
    }


    // (OPSIONAL) LIHAT ORDER USER
    public function myOrders()
    {
        requireLogin();
        global $conn;

        $userId = $_SESSION['user']['id'];

        $orders = mysqli_query($conn, "
            SELECT orders.*, products.name, products.price
            FROM orders
            JOIN products ON products.id = orders.product_id
            WHERE user_id = $userId
        ");

        require "../app/views/customer/my_orders.php";
    }
}