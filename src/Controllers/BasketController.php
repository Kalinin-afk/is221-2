<?php 
namespace App\Controllers;

class BasketController {
    public function add(): void {
        if (isset($_POST['id'])) {
            $product_id = $_POST['id'];
            $size = $_POST['size'] ?? 'M'; // ✅ Получаем размер из формы
            
            if (!isset($_SESSION['basket'])) {
                $_SESSION['basket'] = [];
            }

            if (isset($_SESSION['basket'][$product_id])) {
                $_SESSION['basket'][$product_id]['quantity']++;
            } else {
                $_SESSION['basket'][$product_id] = [
                    'quantity' => 1,
                    'size' => $size // ✅ Сохраняем размер
                ];
            }

            $_SESSION['flash'] = "Товар успешно добавлен в корзину!";
        }
    }

    public function clear(): void {
        $_SESSION['basket'] = [];
        $_SESSION['flash'] = "Корзина очищена.";
    }
}