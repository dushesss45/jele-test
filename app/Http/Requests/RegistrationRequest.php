<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * Запрос на регистрацию нового пользователя.
 *
 * Проверяет и валидирует входные данные:
 * - email
 * - password
 * - gender
 *
 * Используется в {@see \App\Http\Controllers\AuthController::register()}.
 */
class RegistrationRequest extends FormRequest
{
    /**
     * Определяет, авторизован ли пользователь на выполнение запроса.
     *
     * В данном случае доступ разрешён всем (гостям).
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Возвращает правила валидации для запроса регистрации.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email',
            'password' => ['required', Password::min(6)],
            'gender' => 'required|in:male,female,other',
        ];
    }
}
