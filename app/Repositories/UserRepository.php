<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий для работы с пользователями.
 *
 * Инкапсулирует всю работу с моделью User и изолирует её от бизнес-логики.
 */
final class UserRepository
{
    /**
     * Получить всех пользователей.
     *
     * @return Collection<int, User>
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * Создать нового пользователя.
     *
     * @param array<string, mixed> $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Обновить данные пользователя.
     *
     * @param User $user
     * @param array<string, mixed> $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    /**
     * Удалить пользователя.
     *
     * @param User $user
     * @return void
     */
    public function delete(User $user): void
    {
        $user->delete();
    }
}
