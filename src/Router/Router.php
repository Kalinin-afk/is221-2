<?php 
namespace App\Router;

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\BasketController;
use App\Controllers\OrderController;
use App\Controllers\RegisterController;
use App\Controllers\UserController;

class Router {
    public function route(string $url): string {
        $path = parse_url($url, PHP_URL_PATH);
        $pieces = explode("/", $path);
        $resource = $pieces[2] ?? null;

        switch ($resource) {
            case "about":
                return (new AboutController())->get();

            case "order":
                return (new OrderController())->get();

            case "orders":
                return (new OrderController())->getHistory();

            case "register":
                return (new RegisterController())->get();

            case "verify":
                $token = $pieces[3] ?? null;
                return (new RegisterController())->verify($token);

            case "login":
                return (new UserController())->get();

            case "logout":
                unset($_SESSION['user_id']);
                unset($_SESSION['username']);
                session_destroy();
                header("Location: /barhat-life/");
                return "";

            case "basket_clear":
                (new BasketController())->clear();
                $prevUrl = $_SERVER['HTTP_REFERER'] ?? "/barhat-life/";
                header("Location: {$prevUrl}");
                return "";

            case "products":
                $productController = new ProductController();
                $id = $pieces[3] ?? null;
                return $productController->get($id ? intval($id) : null);

            case "basket":
                (new BasketController())->add();
                $prevUrl = $_SERVER['HTTP_REFERER'] ?? "/barhat-life/";
                header("Location: {$prevUrl}");
                return "";

            default:
                return (new HomeController())->get();
        }
    }
}