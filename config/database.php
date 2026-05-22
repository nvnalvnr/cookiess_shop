<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "cookiess_shop";

/*
    KONEKSI DATABASE
*/

$conn = mysqli_connect($host, $user, $pass, $db);

/*
    CEK KONEKSI
*/

if (!$conn) {
    die("Koneksi database gagal");
}