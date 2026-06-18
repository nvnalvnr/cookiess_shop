<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$url = $_GET['url'] ?? 'auth/login';

$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';

$method = $url[1] ?? 'login';

require_once "../app/controllers/$controllerName.php";

$controller = new $controllerName();

$controller->$method();
