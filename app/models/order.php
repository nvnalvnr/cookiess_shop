<?php

class Order
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

  public function create($userId, $productId, $quantity, $totalPrice)
{
    $query = "
        INSERT INTO orders (user_id, product_id, quantity, total_price)
        VALUES ('$userId', '$productId', '$quantity', '$totalPrice')
    ";

    return mysqli_query($this->conn, $query);
}
public function getAll()
{
    $query = "
        SELECT 
            orders.*,
            products.name AS product_name,
            products.price AS product_price
        FROM orders
        JOIN products ON orders.product_id = products.id
        ORDER BY orders.id DESC
    ";

    $result = mysqli_query($this->conn, $query);

    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}
}