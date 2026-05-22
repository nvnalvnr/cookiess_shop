<?php

require_once "../config/database.php";
require_once "../app/models/Product.php";

class ProductController
{
    public function index()
    {
        global $conn;

        $productModel = new Product($conn);

        $products = $productModel->getAll();

        require_once "../app/views/products/index.php";
    }

    public function create()
    {
        require_once "../app/views/products/create.php";
    }

    public function store()
    {
        global $conn;

        $productModel = new Product($conn);

        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        if (empty($name) || empty($price) || empty($stock)) {
            echo "Semua field wajib diisi";
            return;
        }

        $productModel->create($name, $price, $stock);

        header("Location: index.php?url=product/index");
        exit;
    }

    public function edit()
{
    global $conn;

    $id = $_GET['id'];

    $productModel = new Product($conn);

    $product = mysqli_fetch_assoc(
        $productModel->find($id)
    );

    require_once "../app/views/products/edit.php";
}

public function update()
{
    global $conn;

    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $productModel = new Product($conn);

    $productModel->update(
        $id,
        $name,
        $price,
        $stock
    );

    header("Location: index.php?url=product/index");
    exit;
}
}