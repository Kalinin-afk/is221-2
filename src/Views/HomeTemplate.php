<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class HomeTemplate extends BaseTemplate {
    public static function getTemplate(): string {
        $template = parent::getTemplate();
        $title = 'barhat-life — Ваша бархатная жизнь';
        $content = <<<CORUSEL
        <section class="text-center my-5">
            <div class="container">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" style="height: 60vh;">
                        <!-- Первый слайд -->
                        <div class="carousel-item active">
                            <img src="https://localhost/barhat-life/assets/images/slider1.jpg" 
                                 class="d-block w-100" 
                                 style="object-fit: contain; height: 60vh;" 
                                 alt="...">
                        </div>
                        <!-- Второй слайд -->
                        <div class="carousel-item">
                            <img src="https://localhost/barhat-life/assets/images/slider2.jpg" 
                                 class="d-block w-100" 
                                 style="object-fit: contain; height: 60vh;" 
                                 alt="...">
                        </div>
                        <!-- Третий слайд -->
                        <div class="carousel-item">
                            <img src="https://localhost/barhat-life/assets/images/slider3.jpg" 
                                 class="d-block w-100" 
                                 style="object-fit: contain; height: 60vh;" 
                                 alt="...">
                        </div>
                    </div>
                    <!-- Кнопки навигации -->
                    <button class="carousel-control-prev" type="button" 
                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" 
                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <main class="row p-5">
            <div class="col-12 text-center">
                <h1>Вместе с barhat-life</h1>
                <p class="lead mt-3">Вас ждёт только бархатная жизнь.</p>
                <a href="https://localhost/barhat-life/products" class="btn btn-primary btn-lg mt-4">Перейти в каталог</a>
            </div>
        </main>        
        CORUSEL;

        return sprintf($template, $title, $content);
    }
}