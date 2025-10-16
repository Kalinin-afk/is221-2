<?php 
namespace App\Services;

class ValidateOrderData {
    public static function validate(array $data): bool {
        if (empty($data['fio'])) {
            $_SESSION['flash'] = "ФИО обязательно";
            return false;
        }
        if (empty($data['address']) || strlen($data['address']) < 10) {
            $_SESSION['flash'] = "Адрес должен быть не менее 10 символов";
            return false;
        }
        if (empty($data['phone']) || !preg_match('/^\\+?[0-9]{10,12}$/', $data['phone'])) {
            $_SESSION['flash'] = "Некорректный телефон";
            return false;
        }
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash'] = "Некорректный email";
            return false;
        }
        return true;
    }
}