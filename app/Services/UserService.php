<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис бизнес-логики для управления пользователями.
 *
 * Отвечает за создание, обновление, удаление и получение пользователей.
 */
final class UserService
{
    /**
     * @param UserRepository $userRepository Репозиторий пользователей
     */
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    /**
     * Получить список всех пользователей.
     *
     * @return Collection<int, User>
     */
    public function list(): Collection
    {
        return $this->userRepository->all();
    }

    /**
     * Создать нового пользователя.
     *
     * @param array<string, mixed> $data Валидационные данные из формы
     * @return User
     */
    public function create(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        $data['is_admin'] = $data['is_admin'] ?? false;

        return $this->userRepository->create($data);
    }

    /**
     * Обновить существующего пользователя.
     *
     * @param User $user Модель пользователя
     * @param array<string, mixed> $data Обновлённые данные
     * @return User
     */
    public function update(User $user, array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepository->update($user, $data);
    }

    /**
     * Удалить пользователя.
     *
     * @param User $user Модель пользователя
     * @return void
     */
    public function delete(User $user): void
    {
        $this->userRepository->delete($user);
    }

    /**
     * Получить текущего авторизованного пользователя.
     *
     * @return User
     */
    public function getCurrent(): User
    {
        /** @var User $user */
        $user = auth()->user();
        return $user;
    }

    /**
     * Вернуть текущего пользователя как коллекцию (для index).
     *
     * @return Collection<int, User>
     */
    public function getCurrentAsCollection(): Collection
    {
        return new Collection([$this->getCurrent()]);
    }

    /**
     * Обновить текущего пользователя.
     *
     * @param array<string, mixed> $data
     * @return User
     */
    public function updateCurrent(array $data): User
    {
        return $this->update($this->getCurrent(), $data);
    }

    /**
     * Удалить текущего пользователя.
     *
     * @return void
     */
    public function deleteCurrent(): void
    {
        $this->delete($this->getCurrent());
    }
}
