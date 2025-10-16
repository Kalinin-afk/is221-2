<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class UserTemplate extends BaseTemplate {
    public static function getUserTemplate(): string {
        $template = parent::getTemplate();
        $title = 'Вход в аккаунт';
        $content = <<<FORM
        <main class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white text-center pb-4">
                            <h4 class="mb-0">Войти в аккаунт</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="https://localhost/barhat-life/login" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Логин или Email</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Пароль</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-2 fs-5">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Войти
                                </button>
                                <div class="text-center mt-3">
                                    <small class="text-muted">Нет аккаунта? 
                                        <a href="https://localhost/barhat-life//register">Зарегистрируйтесь</a>
                                    </small>
                                </div>
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