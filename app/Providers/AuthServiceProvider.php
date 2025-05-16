<?php
declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Регистрация политик доступа (Policies) для моделей.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Связь моделей с политиками.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Регистрация сервисов (если нужно).
     */
    public function register(): void
    {
        //
    }

    /**
     * Регистрация политик авторизации.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
