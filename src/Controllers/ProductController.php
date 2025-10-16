<?php 
namespace App\Controllers;

use App\Views\ProductTemplate;
use App\Models\Product;
use App\Services\ProductFactory;
use App\Configs\Config;

class ProductController {
    public function get(?int $id): string {
        $model = ProductFactory::createProduct();
        $data = $model->loadData();

        if (!isset($id)) {
            return ProductTemplate::getAllTemplate($data);
        }

        if ($id && $id <= count($data)) {
            $record = $data[$id - 1];
            return ProductTemplate::getCardTemplate($record);
        } else {
            return ProductTemplate::getCardTemplate(null);
        }
    }

    // ✅ Метод для фильтрации по категории
    public function getByCategory(string $category): string {
        $model = ProductFactory::createProduct();
        $data = $model->getByCategory($category);
        return ProductTemplate::getAllTemplate($data);
    }
}