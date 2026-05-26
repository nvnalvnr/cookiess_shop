<?php
require_once "../app/middleware/auth.php";
class DashboardController
{
    public function index()
    {
        requireLogin();
        require_once "../app/views/dashboard/index.php";
        

    }
}