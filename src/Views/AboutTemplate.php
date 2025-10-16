<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class AboutTemplate extends BaseTemplate {
    public static function getTemplate(): string {
        $template = parent::getTemplate();
        $title = 'О нас';
        $content = <<<CORUSEL
        <main class="container mt-5">
            <h1>О нас</h1>
            <p>Студенты группы ИС-221 Кемеровского кооперативного техникума создали интернет-магазин мужской одежды barhat-life.</p>
            <p>Проект разработан в рамках обучения по специальности "Специалист по информационным технологиям".</p>
            <!-- Контейнер для карты -->
            <div id="map" style="width: 100%; height: 500px; margin-top: 30px;"></div>
            <!-- Инициализация карты -->
            <script>
                // Загрузка API Яндекс.Карт
                ymaps.ready(init);
                function init() {
                    var myMap = new ymaps.Map("map", {
                        center: [55.333985, 86.133801], // Координаты Кемерово
                        zoom: 16
                    });

                    var placemark = new ymaps.Placemark([55.333985, 86.133801], {
                        balloonContent: "barhat-life<br>г. Кемерово, ул. Тухачевского, д. 32",
                        hintContent: "barhat-life"
                    });

                    myMap.geoObjects.add(placemark);
                }
            </script>
        </main>        
        CORUSEL;
        return sprintf($template, $title, $content);
    }
}