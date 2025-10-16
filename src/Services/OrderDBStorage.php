<?php 
namespace App\Services;

use PDO;
use App\Configs\Config;

class OrderDBStorage extends DBStorage implements ISaveStorage {
    // ✅ Сохранение заказа в таблице `orders` и позиций в `order_item`
    public function saveData(string $name, array $data): bool {
        $sql = "INSERT INTO `orders` 
        (`user_id`, `fio`, `address`, `phone`, `email`, `all_sum`, `created_at`) 
        VALUES 
        (:user_id, :fio, :address, :phone, :email, :sum, :created_at)";
        
        $sth = $this->connection->prepare($sql);
        $result = $sth->execute([
            'user_id' => $data['user_id'] ?? null,
            'fio' => $data['fio'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'sum' => $data['all_sum'],
            'created_at' => $data['created_at']
        ]);

        // Получаем ID созданного заказа
        $idOrder = $this->connection->lastInsertId();
        // Сохраняем позиции заказа
        $this->saveItems($idOrder, $data['products']);
        return $result;
    }

    // ✅ Сохранение позиций заказа с размером
    public function saveItems(int $idOrder, array $products): bool {
        foreach ($products as $product) {
            $id = $product['id'];
            $price = $product['price'];
            $quantity = $product['quantity'];
            $sum = $price * $quantity;
            $size = $product['size'] ?? 'M'; // ✅ Получаем размер из корзины

            $sql = "INSERT INTO `order_item` 
                    (`order_id`, `product_id`, `size`, `count_item`, `price_item`, `sum_item`) 
                    VALUES 
                    (:id_order, :id_product, :size, :count, :price, :sum)";
            $sth = $this->connection->prepare($sql);
            $sth->execute([
                'id_order' => $idOrder,
                'id_product' => $id,
                'size' => $size, // ✅ Сохраняем размер
                'count' => $quantity,
                'price' => $price,
                'sum' => $sum
            ]);
        }
        return true;
    }

    // ✅ Метод для загрузки заказов пользователя с размерами
    public function loadOrdersByUserId(int $userId): ?array {
        $sql = "SELECT o.id, o.fio, o.address, o.phone, o.email, o.all_sum, o.created_at, o.status, p.name, oi.size
                FROM orders o
                JOIN order_item oi ON o.id = oi.order_id
                JOIN products p ON oi.product_id = p.id
                WHERE o.user_id = ?
                ORDER BY o.created_at DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}