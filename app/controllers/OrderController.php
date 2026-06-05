<?php

require_once "../config/database.php";
require_once "../app/models/Order.php";

class OrderController
{
    public function index()
    {
        global $conn;

        $orderModel = new Order($conn);

        $orders = $orderModel->getAll();

        require_once "../app/views/orders/index.php";
    }

    public function create()
    {
        global $conn;

        $productId = $_GET['id'];

        $query = "SELECT * FROM products WHERE id = $productId";
        $result = mysqli_query($conn, $query);

        $product = mysqli_fetch_assoc($result);

        require_once "../app/views/customer/order_form.php";
    }

    public function store()
{
    global $conn;

    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // 🔥 ambil harga produk dari database
    $query = "SELECT price FROM products WHERE id = $productId";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    $price = $product['price'];

    // 🔥 hitung total price
    $totalPrice = $price * $quantity;

    $orderModel = new Order($conn);

    $orderModel->create(
        $userId,
        $productId,
        $quantity,
        $totalPrice
    );

    header("Location: index.php?url=order/index");
    exit;
}
}