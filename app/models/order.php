<?php

class Order
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        $query = "
            SELECT
                orders.id,
                users.name AS customer_name,
                products.name AS product_name,
                orders.quantity,
                orders.total_price,
                orders.status
            FROM orders
            JOIN users ON users.id = orders.user_id
            JOIN products ON products.id = orders.product_id
            ORDER BY orders.id DESC
        ";

        $result = mysqli_query($this->conn, $query);

        $data = [];

        while ($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }

        return $data;
    }

    public function getByUser($userId)
    {
        $query = "
            SELECT
                orders.id,
                products.name AS product_name,
                orders.quantity,
                orders.total_price,
                orders.status
            FROM orders
            JOIN products ON products.id = orders.product_id
            WHERE orders.user_id = '$userId'
            ORDER BY orders.id DESC
        ";

        $result = mysqli_query($this->conn, $query);

        $data = [];

        while ($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }

        return $data;
    }

    public function getRecentOrders()
    {
        $query = "
            SELECT
                users.name AS customer_name,
                products.name AS product_name,
                orders.status
            FROM orders
            JOIN users ON users.id = orders.user_id
            JOIN products ON products.id = orders.product_id
            ORDER BY orders.id DESC
            LIMIT 5
        ";

        $result = mysqli_query($this->conn, $query);

        $data = [];

        while ($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }

        return $data;
    }

    public function create($userId, $productId, $quantity, $totalPrice)
    {
        $query = "
            INSERT INTO orders
            (user_id, product_id, quantity, total_price)
            VALUES
            ('$userId', '$productId', '$quantity', '$totalPrice')
        ";

        return mysqli_query($this->conn, $query);
    }

    public function updateStatus($id, $status)
    {
        $query = "
            UPDATE orders
            SET status = '$status'
            WHERE id = '$id'
        ";

        return mysqli_query($this->conn, $query);
    }
}