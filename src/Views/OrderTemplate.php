<?php 
namespace App\Views;

use App\Views\BaseTemplate;
use App\Configs\Config;

class OrderTemplate extends BaseTemplate {
    // ✅ Отображение корзины с размером товара
    public static function getOrderTemplate(?array $products, float $all_sum): string {
        $template = parent::getTemplate();
        $title = "Корзина и оформление заказа";
        $content = <<<CORUSEL
        <main class="container mt-5">
            <h2 class="mb-4">Ваша корзина</h2>
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-5"><strong>Название</strong></div>
                                <div class="col-2"><strong>Количество</strong></div>
                                <div class="col-2"><strong>Размер</strong></div>
                                <div class="col-2"><strong>Сумма</strong></div>
                            </div>
        CORUSEL;

        foreach ($products as $product) {
            $sum = $product['price'] * $product['quantity'];
            $content .= <<<LINE
            <div class="row mb-2 align-items-center">
                <div class="col-5">{$product['name']}</div>
                <div class="col-2">{$product['quantity']} ед.</div>
                <div class="col-2">{$product['size']}</div> <!-- ✅ Размер товара -->
                <div class="col-2">{$sum} ₽</div>
            </div>
            LINE;
        }

        $content .= <<<FORM
            <hr>
            <div class="mt-4">
                <p><strong>Общая сумма:</strong> {$all_sum} ₽</p>
                <a href="https://localhost/barhat-life/basket_clear" class="btn btn-outline-danger me-2">Очистить корзину</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm mt-4 border-0">
            <div class="card-body">
                <h5 class="card-title mb-4">Данные для доставки</h5>
                <form action="https://localhost/barhat-life/order" method="POST">
                    <div class="mb-3">
                        <label for="fioInput" class="form-label">ФИО:</label>
                        <input type="text" name="fio" class="form-control" id="fioInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="addressInput" class="form-label">Адрес доставки:</label>
                        <input type="text" name="address" class="form-control" id="addressInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">Телефон:</label>
                        <input type="text" name="phone" class="form-control" id="phoneInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="emailInput" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                        <i class="bi bi-cart-check me-2"></i>Оформить заказ
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
FORM;

        return sprintf($template, $title, $content);
    }
}