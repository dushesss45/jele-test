<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

/**
 * Политика доступа к модели User.
 * Позволяет управлять пользователем самому себе или администратору.
 */
class UserPolicy
{
    /**
     * Определяет, может ли $actingUser управлять $targetUser.
     *
     * Управление включает: редактирование, удаление и т.п.
     * Разрешено, если:
     * - пользователь является админом (is_admin === true), либо
     * - пользователь редактирует сам себя.
     *
     * @param User $actingUser Пользователь, совершающий действие
     * @param User $targetUser Целевой пользователь
     *
     * @return bool true, если разрешено
     */
    public function manage(User $actingUser, User $targetUser): bool
    {
        return $actingUser->is_admin || $actingUser->id === $targetUser->id;
    }
}
