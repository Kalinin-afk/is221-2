<?php 
namespace App\Controllers;

use App\Views\UserTemplate;
use App\Services\UserDBStorage;
use App\Configs\Config;

class UserController {
    public function get(): string {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "POST")
            return $this->login();
        return UserTemplate::getUserTemplate();
    }

    public function login(): string {
        $arr = [];
        $arr['username'] = strip_tags($_POST['username']);
        $arr['password'] = strip_tags($_POST['password']);
        
        if (Config::STORAGE_TYPE == Config::TYPE_DB) {
            $serviceDB = new UserDBStorage();
            if (!$serviceDB->loginUser($arr['username'], $arr['password'])) {
                $_SESSION['flash'] = "Ошибка ввода логина или пароля";
                return UserTemplate::getUserTemplate();
            }
        }
        header("Location: /barhat-life/");
        return "";
    }
}