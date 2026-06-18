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

        // Total Produk
        $totalProduk = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT COUNT(*) as total FROM products"
            )
        )['total'];

        // Total User
        $totalUser = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT COUNT(*) as total FROM users"
            )
        )['total'];

        // Total Orders
        $totalOrders = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT COUNT(*) as total FROM orders"
            )
        )['total'];

        // Total Pending Orders
        $totalPending = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT COUNT(*) as total
                 FROM orders
                 WHERE status = 'pending'"
            )
        )['total'];

        // Total Revenue
        $totalRevenue = mysqli_fetch_assoc(
            mysqli_query(
                $conn,
                "SELECT SUM(total_price) as total
                 FROM orders
                 WHERE status = 'completed'"
            )
        )['total'];

        // Latest Products
        $productModel = new Product($conn);
        $latestProducts = $productModel->getLatestProducts();

        // Recent Orders
        $orderModel = new Order($conn);
        $recentOrders = $orderModel->getRecentOrders();

        require_once "../app/views/dashboard/index.php";
    }
}