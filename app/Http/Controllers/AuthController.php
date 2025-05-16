<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\RegistrationData;
use App\Http\Requests\RegistrationRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер для аутентификации и регистрации пользователей.
 */
final class AuthController extends Controller
{
    /**
     * Сервис регистрации пользователей.
     *
     * @var RegistrationService
     */
    private readonly RegistrationService $registrationService;

    /**
     * @param RegistrationService $registrationService
     */
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Обрабатывает запрос на регистрацию нового пользователя.
     *
     * @param RegistrationRequest $request
     * @return JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        $dto = new RegistrationData(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
            $request->input('gender')
        );

        $response = $this->registrationService->register($dto);

        return $this->jsonResponse($response, 201);
    }
}
