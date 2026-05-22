<?php

require_once "../config/database.php";

class AuthController
{
    // Tampilkan halaman login
    public function login()
    {
        require_once "../app/views/auth/login.php";
    }

    // Proses login
    public function processLogin()
    {
        global $conn;

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validasi
        if (empty($email) || empty($password)) {
            echo "Email dan password wajib diisi";
            return;
        }

        // Cari user berdasarkan email
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $user = mysqli_fetch_assoc($result);

            // Cocokkan password
            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php?url=dashboard/index");
                exit;

            } else {

                echo "Password salah";
            }

        } else {

            echo "Email tidak ditemukan";
        }
    }

    // Tampilkan halaman register
    public function register()
    {
        require_once "../app/views/auth/register.php";
    }

    // Proses register
    public function processRegister()
    {
        global $conn;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validasi
        if (empty($name) || empty($email) || empty($password)) {

            echo "Semua field wajib diisi";
            return;
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan ke database
        $query = "INSERT INTO users (name, email, password)
                  VALUES ('$name', '$email', '$hashedPassword')";

        $insert = mysqli_query($conn, $query);

        if ($insert) {

            echo "REGISTER BERHASIL";

        } else {

            echo "REGISTER GAGAL";
        }
    }
}