<?php 
namespace App\Services;

use App\Configs\Config;
use App\Models\User;
use App\Services\UserDBStorage;
use App\Services\FileStorage;

class UserFactory {
    public static function createUser(): User {
        if (Config::STORAGE_TYPE == Config::TYPE_FILE) {
            return new User(new FileStorage(), Config::FILE_PRODUCTS);
        }
        if (Config::STORAGE_TYPE == Config::TYPE_DB) {
            return new User(new UserDBStorage(), Config::TABLE_PRODUCTS);
        }
    }
}