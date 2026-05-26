
<?php

function requireLogin()
{
    if (!isset($_SESSION['user_id'])) {

        header("Location: index.php?url=auth/login");
        exit;
    }
}