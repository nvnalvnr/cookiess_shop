<?php
require_once "../config/database.php";
require_once "../app/middleware/auth.php";

class DashboardController
{
    public function index()
    {
        requireLogin();
        global $conn;

        $totalProduk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products"))['total'];
        $totalUser   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
        $totalOrders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
        require_once "../app/views/dashboard/index.php";
    }
}