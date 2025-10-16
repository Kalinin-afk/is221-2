<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class RegisterTemplate extends BaseTemplate {
    public static function getRegisterTemplate(): string {
        $template = parent::getTemplate();
        $title = 'Регистрация';
        $content = <<<FORM
        <main class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white text-center pb-4">
                            <h4 class="mb-0">Создайте аккаунт</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="<?= Config::SITE_URL ?>/register" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Имя пользователя</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Пароль (мин. 6 символов)</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Подтверждение пароля</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                                    <i class="bi bi-person-add me-2"></i>Зарегистрироваться
                                </button>
                            </form>
                        </div>
                        <div class="card-footer bg-white text-center">
                            <small>Уже есть аккаунт? 
                                <a href="<?= Config::SITE_URL ?>/login">Войдите</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        FORM;

        return sprintf($template, $title, $content);
    }
}