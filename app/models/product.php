<?php

class Product
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        $query = "SELECT * FROM products";
        return mysqli_query($this->conn, $query);
    }
}