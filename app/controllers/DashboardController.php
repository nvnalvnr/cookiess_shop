<?php

require_once "../config/database.php";
require_once "../app/middleware/auth.php";
require_once "../app/models/Product.php";
require_once "../app/models/Order.php";

class DashboardController
{
    public function index()
    {
        requireLogin();
        global $conn;

        // TOTAL PRODUK
        $queryProduk = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
        $totalProduk = mysqli_fetch_assoc($queryProduk)['total'] ?? 0;

        // TOTAL USER
        $queryUser = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
        $totalUser = mysqli_fetch_assoc($queryUser)['total'] ?? 0;

        // TOTAL ORDERS
        $queryOrders = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
        $totalOrders = mysqli_fetch_assoc($queryOrders)['total'] ?? 0;

        // TOTAL PENDING ORDERS
        $queryPending = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders WHERE status = 'pending'");
        $totalPending = mysqli_fetch_assoc($queryPending)['total'] ?? 0;

        // TOTAL REVENUE (completed orders only)
        $queryRevenue = mysqli_query($conn, "SELECT SUM(total_price) AS total FROM orders WHERE status = 'completed'");
        $totalRevenue = mysqli_fetch_assoc($queryRevenue)['total'] ?? 0;

        // LATEST PRODUCTS
        $productModel = new Product($conn);
        $latestProducts = $productModel->getLatestProducts();

        // DATA ORDER TERBARU (buat tabel dashboard)
        $queryRecentOrders = mysqli_query($conn, "
            SELECT o.*, p.name AS product_name, u.name AS customer_name
            FROM orders o
            JOIN products p ON p.id = o.product_id
            JOIN users u ON u.id = o.user_id
            ORDER BY o.id DESC
            LIMIT 5
        ");

        $recentOrders = [];
        while ($row = mysqli_fetch_assoc($queryRecentOrders)) {
            $recentOrders[] = $row;
        }

        // kirim ke view
        require "../app/views/dashboard/index.php";
    }
}