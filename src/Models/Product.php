<?php 
namespace App\Models;

use App\Services\ILoadStorage;

class Product {
    private ILoadStorage $dataStorage;
    private string $nameResource;

    public function __construct(ILoadStorage $service, string $name) {
        $this->dataStorage = $service;
        $this->nameResource = $name;
    }

    public function loadData(): ?array {
        return $this->dataStorage->loadData($this->nameResource);
    }

    public function getBasketData(): array {
        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }
        $products = $this->loadData();
        $basketProducts = [];

        foreach ($products as $product) {
            $id = $product['id'];
            if (isset($_SESSION['basket'][$id])) {
                $quantity = $_SESSION['basket'][$id]['quantity'];
                $size = $_SESSION['basket'][$id]['size'] ?? 'M'; // ✅ Размер из корзины

                $basketProducts[] = array_merge($product, [
                    'quantity' => $quantity,
                    'size' => $size
                ]);
            }
        }
        return $basketProducts;
    }

    public function getAllSum(?array $products): float {
        $all_sum = 0;
        foreach ($products as $product) {
            $all_sum += $product['price'] * $product['quantity'];
        }
        return $all_sum;
    }

    // ✅ Метод для фильтрации по категории
    public function getByCategory(string $category): array {
        $products = $this->loadData();
        $filtered = [];

        foreach ($products as $product) {
            if (isset($product['category']) && $product['category'] === $category) {
                $filtered[] = $product;
            }
        }
        return $filtered;
    }
}