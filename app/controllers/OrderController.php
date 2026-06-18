<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/Order.php";

class OrderController
{
    public function index()
    {
        global $conn;

        $orderModel = new Order($conn);
        $orders = $orderModel->getAll();

        require_once __DIR__ . "/../views/orders/index.php";
    }

    public function myOrders()
    {
        global $conn;

        $userId = $_SESSION['user_id'];

        $orderModel = new Order($conn);
        $orders = $orderModel->getByUser($userId);

        require_once __DIR__ . "/../views/customer/my_orders.php";
    }

    public function create()
    {
        global $conn;

        $productId = $_GET['id'];

        $query = "SELECT * FROM products WHERE id = $productId";
        $result = mysqli_query($conn, $query);

        $product = mysqli_fetch_assoc($result);

        require_once __DIR__ . "/../views/customer/order_form.php";
    }

    public function store()
    {
        global $conn;

        $userId = $_SESSION['user_id'];
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $query = "SELECT price, stock FROM products WHERE id = $productId";
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);

        if ($quantity > $product['stock']) {
            die("Stok tidak mencukupi");
        }

        $price = $product['price'];
        $totalPrice = $price * $quantity;

        $orderModel = new Order($conn);

        $orderModel->create(
            $userId,
            $productId,
            $quantity,
            $totalPrice
        );

        $newStock = $product['stock'] - $quantity;

        mysqli_query(
            $conn,
            "UPDATE products
             SET stock = $newStock
             WHERE id = $productId"
        );

        header("Location: index.php?url=customer/my-orders");
        exit;
    }

    public function updateStatus()
    {
        global $conn;

        $id = $_POST['id'];
        $status = $_POST['status'];

        $orderModel = new Order($conn);
        $orderModel->updateStatus($id, $status);

        header("Location: index.php?url=order/index");
        exit;
    }
}