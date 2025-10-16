<?php 
namespace App\Services;

use PDO;
use App\Configs\Config;

class ProductDBStorage extends DBStorage implements ILoadStorage {
    public function loadData($nameFile): ?array {
        $sql = "SELECT id, name, description, image, price, category FROM " . Config::TABLE_PRODUCTS;
        $result = $this->connection->query($sql, PDO::FETCH_ASSOC);
        return $result->fetchAll();
    }
}