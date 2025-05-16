<?php
declare(strict_types=1);

namespace App\DTO;

/**
 * DTO для регистрации пользователя.
 *
 * Используется для переноса валидированных данных из запроса в сервис.
 *
 * @readonly
 */
final readonly class RegistrationData
{
    /**
     * @param string $name     Имя пользователя (отображается в профиле)
     * @param string $email    Email пользователя
     * @param string $password Пароль в сыром виде (будет хеширован)
     * @param string $gender   Пол: 'male', 'female' или 'other'
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $gender,
    ) {}
}
