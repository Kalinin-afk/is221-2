<?php 
require_once "./vendor/autoload.php";
use App\Router\Router;

session_start();

// Инициализация $user_id и $username
$user_id = $_SESSION['user_id'] ?? 0;
$username = $_SESSION['username'] ?? "";

$router = new Router();
$url = $_SERVER['REQUEST_URI'];
echo $router->route($url);	