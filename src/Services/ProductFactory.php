<?php 
namespace App\Services;

use App\Configs\Config;
use App\Models\Product;
use App\Services\ProductDBStorage;
use App\Services\FileStorage;

class ProductFactory {
    public static function createProduct(): Product {
        if (Config::STORAGE_TYPE == Config::TYPE_DB) {
            return new Product(new ProductDBStorage(), Config::TABLE_PRODUCTS);
        } else {
            return new Product(new FileStorage(), Config::FILE_PRODUCTS);
        }
    }
}