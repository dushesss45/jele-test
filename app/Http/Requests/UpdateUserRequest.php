<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * Запрос на обновление существующего пользователя.
 *
 * Поддерживает частичное обновление (PATCH/PUT) следующих полей:
 * - email: должен быть валидным и уникальным, кроме текущего пользователя
 * - password: может быть null, минимум 6 символов, если задан
 * - gender: должен быть одним из male, female, other
 * - is_admin: булево значение (только если поле передано)
 *
 * Используется в {@see \App\Http\Controllers\UserController::update()}.
 */
final class UpdateUserRequest extends FormRequest
{
    /**
     * Проверка авторизации пользователя на выполнение запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации для запроса обновления пользователя.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')->id ?? null;

        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => "sometimes|email|unique:users,email,{$userId}",
            'password' => ['nullable', Password::min(6)],
            'gender'   => 'sometimes|in:male,female,other',
            'is_admin' => 'sometimes|boolean',
        ];
    }
}
