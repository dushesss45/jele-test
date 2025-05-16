<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер для управления текущим пользователем через /profile.
 *
 * Поддерживает:
 * - Получение профиля (GET /profile)
 * - Обновление профиля (PUT /profile)
 * - Удаление профиля (DELETE /profile)
 */
final class UserController extends Controller
{
    /**
     * @param UserService $userService Сервис бизнес-логики пользователей
     */
    public function __construct(private readonly UserService $userService) {}

    /**
     * Получить текущего пользователя как коллекцию (совместимо с index-ответами).
     *
     * GET /profile
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse($this->userService->getCurrentAsCollection());
    }

    /**
     * Обновить текущего пользователя.
     *
     * PUT /profile/{user}
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->authorize('manage', $user);
        $updated = $this->userService->update($user, $request->validated());

        return $this->jsonResponse($updated);
    }

}
