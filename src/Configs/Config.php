<?php 
namespace App\Configs;

class Config {
    const FILE_PRODUCTS = "./storage/data.json";
    const FILE_ORDERS = "./storage/order.json";
    const TYPE_FILE = "file";
    const TYPE_DB = "db";
    const STORAGE_TYPE = self::TYPE_DB;

    // Настройки БД
    const MYSQL_DNS = 'mysql:dbname=barhan-magazin;host=localhost';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';
    
    // Таблицы
    const TABLE_PRODUCTS = "products";
    const TABLE_ORDERS = "orders";
    const TABLE_USERS = "users";
    const SITE_URL = "https://localhost/barhat-life";
}