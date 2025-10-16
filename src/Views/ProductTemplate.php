<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class ProductTemplate extends BaseTemplate {
    public static function getCardTemplate(?array $record): string {
        $template = parent::getTemplate();
        if ($record) {
            $title = "Карточка товара: {$record['name']}";
            $content = <<<CORUSEL
            <main class="container mt-5">
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="position-relative">
                            <img src="{$record['image']}" class="img-fluid rounded shadow-sm" alt="...">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary">{$record['category']}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="mb-4">{$record['name']}</h2>
                        <p class="lead text-muted">{$record['description']}</p>
                        <h4 class="mt-4 mb-4">{$record['price']} ₽</h4>
                        <form action="https://localhost/barhat-life/basket" method="POST">
                            <input type="hidden" name="id" value="{$record['id']}">
                            <div class="mb-3">
                                <label class="form-label">Выберите размер:</label>
                                <select name="size" class="form-select">
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M" selected>M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                                <i class="bi bi-cart-plus me-2"></i>Добавить в корзину
                            </button>
                        </form>
                    </div>
                </div>
            </main>        
            CORUSEL;
        } else {
            $title = "Товар не найден";
            $content = <<<CORUSEL
            <main class="container mt-5">
                <div class="row">
                    <div class="col-12 text-center">
                        <i class="bi bi-box-seam display-1 text-danger mb-3"></i>
                        <h1>Товар не найден</h1>
                        <a href="https://localhost/barhat-life/products" class="btn btn-outline-primary mt-3">
                            Вернуться в каталог
                        </a>
                    </div>
                </div>
            </main>        
            CORUSEL;
        }

        return sprintf($template, $title, $content);
    }

    public static function getAllTemplate(array $arr): string {
        $template = parent::getTemplate();
        $title = 'Каталог товаров';
        $content = <<<GRID
        <main class="container mt-5">
            <div class="row g-4">
        GRID;

        foreach ($arr as $item) {
            $content .= <<<CARD
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 hover-lift">
                        <img src="{$item['image']}" 
                             class="card-img-top" 
                             style="height: 250px; object-fit: contain;">
                        <div class="card-body">
                            <h5 class="card-title">{$item['name']}</h5>
                            <p class="card-text text-muted">{$item['description']}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-bold">{$item['price']} ₽</span>
                                <form action="https://localhost/barhat-life/basket" method="POST">
                                    <input type="hidden" name="id" value="{$item['id']}">
                                    <select name="size" class="form-select form-select-sm mb-2">
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M" selected>M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                        <i class="bi bi-cart-plus me-1"></i>В корзину
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            CARD;
        }

        $content .= "</div></main>";
        return sprintf($template, $title, $content);
    }
}