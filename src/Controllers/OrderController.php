<?php 
namespace App\Controllers;

use App\Views\OrderTemplate;
use App\Models\Product;
use App\Services\OrderDBStorage;
use App\Configs\Config;
use App\Services\ValidateOrderData;
use App\Services\Mailer;
use App\Services\ProductFactory;

class OrderController {
    public function get(): string {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST")
            return $this->create();
        
        $model = ProductFactory::createProduct();
        $data = $model->getBasketData();
        $all_sum = $model->getAllSum($data);
        return OrderTemplate::getOrderTemplate($data, $all_sum);
    }

    public function create(): string {
        $arr = [];
        $arr['fio'] = strip_tags($_POST['fio']);
        $arr['address'] = strip_tags($_POST['address']);
        $arr['phone'] = strip_tags($_POST['phone']);
        $arr['email'] = strip_tags($_POST['email']);
        $arr['created_at'] = date("Y-m-d H:i:s"); 

        if (! ValidateOrderData::validate($arr)) {
            header("Location: /barhat-life/order");
            return "";
        }

        $model = ProductFactory::createProduct();
        $products = $model->getBasketData();
        $all_sum = $model->getAllSum($products);

        $arr['all_sum'] = $all_sum;
        $arr['products'] = $products;
        $arr['user_id'] = $_SESSION['user_id'] ?? null;

        $orderModel = new OrderDBStorage();
        $orderModel->saveData(Config::TABLE_ORDERS, $arr);
        Mailer::sendOrderMail($arr['email']);

        unset($_SESSION['basket']);
        $_SESSION['flash'] = "Спасибо! Ваш заказ успешно создан.";
        header("Location: /barhat-life/");
        return "";
    }

    // ✅ Добавлен недостающий метод `getHistory()`
    public function getHistory(): string {
        if ($_SESSION['user_id'] <= 0) {
            $_SESSION['flash'] = "Авторизуйтесь, чтобы посмотреть историю заказов";
            header("Location: /barhat-life/login");
            return "";
        }

        $service = new OrderDBStorage();
        $orders = $service->loadOrdersByUserId($_SESSION['user_id']);
        return \App\Views\HistoryTemplate::getHistoryTemplate($orders);
    }
}