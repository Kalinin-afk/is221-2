<?php 
namespace App\Views;

use App\Configs\Config;

class BaseTemplate {
    public static function getTemplate(): string {
        global $user_id, $username;
        $siteUrl = Config::SITE_URL;
        $displayName = $username ?: "Личный кабинет";

        // Подключение API Яндекс.Карт
        $template = <<<LINE
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>%s</title>
            <!-- Подключение стилей -->
            <link rel="stylesheet" href="{$siteUrl}/assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="{$siteUrl}/assets/css/style.css">
            <!-- Подключение иконок -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
            <!-- Подключение Яндекс.Карт -->
            <script src="https://api-maps.yandex.ru/2.1/?apikey=ВАШ_АПИ_КЛЮЧ&lang=ru_RU"></script>
            <!-- Подключение скриптов -->
            <script src="{$siteUrl}/assets/js/bootstrap.bundle.js"></script>
        </head>
        <body class="d-flex flex-column min-vh-100">
            <header>
                <nav class="navbar navbar-expand-lg bg-white shadow-sm">
                    <div class="container-fluid">
                        <!-- Логотип -->
                        <a class="navbar-brand d-flex align-items-center" href="{$siteUrl}">
                            <img src="{$siteUrl}/assets/images/logo.png" width="100" height="80" class="me-2">
                        </a>

                        <!-- Тогглер для мобильных -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Навигационное меню -->
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav mb-2 mb-lg-0">
                                <li class="nav-item"><a class="nav-link" href="{$siteUrl}">Главная</a></li>
                                <li class="nav-item"><a class="nav-link" href="{$siteUrl}/products">Каталог</a></li>
                                <li class="nav-item"><a class="nav-link" href="{$siteUrl}/about">О нас</a></li>
                                <li class="nav-item"><a class="nav-link" href="{$siteUrl}/order">Корзина</a></li>
                                
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Телефон и кнопки входа -->
                <div class="container-fluid bg-light py-2">
                    <div class="container d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-telephone text-muted me-2"></i>
                            <span class="text-muted">+7 (950) 578-53-31</span>
                        </div>
LINE;

        if ($user_id > 0) {
            $template .= <<<USER_MENU
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">{$displayName}</button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{$siteUrl}/orders">История заказов</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="{$siteUrl}/logout">Выход</a></li>
                </ul>
            </div>
USER_MENU;
        } else {
            $template .= <<<LOGIN_BUTTONS
            <div class="btn-group">
                <a href="{$siteUrl}/login" class="btn btn-outline-primary me-2">Войти</a>
                <a href="{$siteUrl}/register" class="btn btn-primary">Регистрация</a>
            </div>
LOGIN_BUTTONS;
        }

        $template .= <<<LINE
                    </div>
                </div>
            </header>
            <!-- Основной контент -->
            %s
            <!-- Подвал -->
            <footer class="bg-light py-4 mt-auto">
                <div class="container text-center text-muted">
                    <p class="mb-0">&copy; 2025 barhat-life. Все права защищены.</p>
                </div>
            </footer>
        </body>
        </html>
LINE;

        return $template;
    }
}