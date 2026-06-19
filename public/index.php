<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$url = $_GET['url'] ?? 'auth/login';
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$method = $url[1] ?? 'index';

$controllerPath = "../app/controllers/$controllerName.php";

if (!file_exists($controllerPath)) {
    die("Controller tidak ditemukan");
}

require_once $controllerPath;

$controller = new $controllerName();

if (!method_exists($controller, $method)) {
    die("Method tidak ditemukan");
}

$controller->$method();