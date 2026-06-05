<?php

require_once "../config/database.php";
require_once "../app/models/Product.php";
require_once "../app/middleware/auth.php";

class ProductController
{
    public function index()
{
    requireLogin();

    global $conn;

    $productModel = new Product($conn);

    $products = $productModel->getAll();

    require_once "../app/views/products/index.php";
}
    public function create()
    {
        requireLogin();
        require_once "../app/views/products/create.php";
    }

  public function store()
{
    requireLogin();

    global $conn;

    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];

    if (
        empty($name) ||
        empty($price) ||
        empty($stock)
    ) {
        echo "Semua field wajib diisi";
        return;
    }

    $productModel = new Product($conn);

    $productModel->create(
        $name,
        $price,
        $stock,
        $image
    );

    header("Location: index.php?url=product/index");
    exit;
}
    public function edit()
    {
        requireLogin();

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
        requireLogin();

        global $conn;

       $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $image = $_POST['image'];
        

        $productModel = new Product($conn);

        $productModel->update(
            $id,
            $name,
            $price,
            $stock,
            $image
        );

        header("Location: index.php?url=product/index");
        exit;
    }

    public function delete()
    {
        requireLogin();

        global $conn;

        $id = $_GET['id'];

        $productModel = new Product($conn);

        $productModel->delete($id);

        header("Location: index.php?url=product/index");
        exit;
    }
}