<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Сидер для таблицы пользователей.
 *
 * Создаёт одного администратора и несколько обычных пользователей.
 */
final class UserSeeder extends Seeder
{
    /**
     * Выполнить сидирование.
     *
     * @return void
     */
    public function run(): void
    {
        // Создание администратора
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'gender'   => 'male',
            'is_admin' => true,
        ]);

        // Создание тестовых пользователей через фабрику
        User::factory()->count(5)->create();
    }
}
