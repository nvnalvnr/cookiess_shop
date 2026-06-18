<?php

require_once "../config/database.php";

class ReportController
{
    public function index()
    {
        global $conn;

        $query = "
            SELECT
                products.name,
                SUM(orders.quantity) AS total_sold,
                SUM(orders.total_price) AS revenue
            FROM orders
            JOIN products
                ON products.id = orders.product_id
            WHERE orders.status = 'completed'
            GROUP BY products.id
            ORDER BY revenue DESC
        ";

        $result = mysqli_query($conn, $query);

        require_once "../app/views/reports/index.php";
    }
}