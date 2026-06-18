<?php

require_once "../config/database.php";
require_once "../app/models/product.php";

class CatalogController
{
    public function index ()
    {
        global $conn;

        $productModel = new Product ($conn);
        
        $products = $productModel ->getAll();
        
        $productModel = new Product($conn);
        $products = $productModel->getAll();


        require_once "../app/views/customer/catalog.php";
        
    }
}