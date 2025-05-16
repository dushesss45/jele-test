<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\DTO\RegistrationData;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Сервис регистрации новых пользователей.
 *
 * Обрабатывает бизнес-логику регистрации: создание пользователя и генерация API-токена.
 */
final class RegistrationService
{
    /**
     * @param UserRepository $userRepository Репозиторий пользователей
     */
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    /**
     * Зарегистрировать нового пользователя.
     *
     * @param RegistrationData $data DTO с данными пользователя
     * @return array{token: string} Возвращает массив с токеном доступа
     */
    public function register(RegistrationData $data): array
    {
        $user = $this->userRepository->create([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => Hash::make($data->password),
            'gender'   => $data->gender,
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return ['token' => $token];
    }
}
