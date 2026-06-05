<?php

require_once "../config/database.php";

class AuthController
{
    // Login Page
    public function login()
    {
        require_once "../app/views/auth/login.php";
    }

    // Proses Login
    public function processLogin()
    {
        global $conn;

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            echo "Email dan password wajib diisi";
            return;
        }

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {

                    header("Location: index.php?url=dashboard/index");

                } else {

                    header("Location: index.php?url=catalog/index");

                }

                exit;

            } else {

                echo "Password salah";

            }

        } else {

            echo "Email tidak ditemukan";

        }
    }

    // Register Page
    public function register()
    {
        require_once "../app/views/auth/register.php";
    }

    // Proses Register
    public function processRegister()
    {
        global $conn;

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($name) || empty($email) || empty($password)) {
            echo "Semua field wajib diisi";
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password)
                  VALUES ('$name', '$email', '$hashedPassword')";

        $insert = mysqli_query($conn, $query);

        if ($insert) {

            echo "REGISTER BERHASIL";

        } else {

            echo "REGISTER GAGAL";

        }
    }

    // Logout
    public function logout()
    {
        session_destroy();

        header("Location: index.php?url=auth/login");
        exit;
    }
}