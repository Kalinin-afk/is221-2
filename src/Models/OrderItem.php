<?php 
namespace App\Models;

class OrderItem {
    private array $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function getId(): int {
        return $this->data['id'];
    }

    public function getSize(): string {
        return $this->data['size'] ?? 'M';
    }

    public function getQuantity(): int {
        return $this->data['quantity'] ?? 0;
    }

    public function getPrice(): float {
        return $this->data['price'] ?? 0.0;
    }

    public function getSum(): float {
        return $this->data['sum_item'] ?? 0.0;
    }
}