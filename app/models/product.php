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
    public function create($name, $price, $stock, $image)
{
    $query = "INSERT INTO products
              (name, price, stock, image)
              VALUES
              ('$name', '$price', '$stock', '$image')";

    return mysqli_query($this->conn, $query);
}
    public function find($id)
{
    $query = "SELECT * FROM products WHERE id = '$id'";

    return mysqli_query($this->conn, $query);
}

public function update($id, $name, $price, $stock, $image)
{
    $query = "UPDATE products
              SET
                name='$name',
                price='$price',
                stock='$stock',
                image='$image'
              WHERE id='$id'";

    return mysqli_query($this->conn, $query);
}
public function delete($id)
{
    $query = "DELETE FROM products WHERE id = '$id'";

    return mysqli_query($this->conn, $query);
}

}