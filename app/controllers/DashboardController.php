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

        // TOTAL ORDER
        $queryOrder = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
        $totalOrder = mysqli_fetch_assoc($queryOrder)['total'] ?? 0;

        // TOTAL PENDAPATAN (opsional tapi sering dipakai)
        $queryIncome = mysqli_query($conn, "SELECT SUM(total_price) AS total FROM orders");
        $totalIncome = mysqli_fetch_assoc($queryIncome)['total'] ?? 0;

        // DATA ORDER TERBARU (buat tabel dashboard)
        $queryRecentOrders = mysqli_query($conn, "
            SELECT o.*, p.name AS product_name
            FROM orders o
            JOIN products p ON p.id = o.product_id
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