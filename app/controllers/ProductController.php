<?php

require_once "../config/database.php";
require_once "../app/models/Product.php";

class ProductController
{
    // Menampilkan semua produk
    public function index()
    {
        global $conn;

        $productModel = new Product($conn);

        $products = $productModel->getAll();

        require_once "../app/views/products/index.php";
    }

    // Menampilkan form tambah produk
    public function create()
    {
        require_once "../app/views/products/create.php";
    }

    // Menyimpan produk baru
    public function store()
    {
        global $conn;

        $productModel = new Product($conn);

        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];

        // Validasi
        if (empty($name) || empty($price) || empty($stock)) {
            echo "Semua field wajib diisi";
            return;
        }

        $productModel->create($name, $price, $stock);

        header("Location: index.php?url=product/index");
        exit;
    }
}