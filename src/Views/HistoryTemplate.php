<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class HistoryTemplate extends BaseTemplate {
    public static function getHistoryTemplate(array $orders = []): string {
        $template = parent::getTemplate();
        $title = "История заказов";
        $content = "<main class='container mt-5'>";

        if (empty($orders)) {
            $content .= <<<NO_ORDERS
            <div class="alert alert-info text-center" role="alert">
                У вас пока нет заказов.
            </div>
            NO_ORDERS;
        } else {
            $content .= "<div class='row g-4'>";
            foreach ($orders as $order) {
                $status = $order['status'] ?? 'в обработке';
                $statusClass = match ($status) {
                    'выполнен' => 'success',
                    'в обработке' => 'primary',
                    'отменён' => 'danger',
                    default => 'warning',
                };

                $content .= <<<ORDER_CARD
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-{$statusClass} text-white">
                            Заказ #{$order['id']} • {$status}
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted">ФИО:</span>
                                    <strong>{$order['fio']}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Адрес:</span>
                                    <strong>{$order['address']}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Телефон:</span>
                                    <strong>{$order['phone']}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Email:</span>
                                    <strong>{$order['email']}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Сумма:</span>
                                    <strong>{$order['all_sum']} ₽</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Дата:</span>
                                    <strong>{$order['created_at']}</strong>
                                </li>
                            </ul>
                            <h6 class="mt-3 mb-2">Товары:</h6>
                            <ul class="list-group">
                ORDER_CARD;

                $currentOrderId = null;
                foreach ($orders as $item) {
                    if ($currentOrderId !== $item['id']) {
                        $currentOrderId = $item['id'];
                        continue;
                    }
                    $content .= <<<ITEM
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{$item['name']}</span>
                        <span class="badge bg-secondary rounded-pill">Размер: {$item['size']}</span>
                    </li>
                    ITEM;
                }

                $content .= "</ul></div></div></div>";
            }
            $content .= "</div>";
        }

        $content .= "</main>";
        return sprintf($template, $title, $content);
    }
}