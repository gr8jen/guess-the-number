<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entities\User;

final class UserFactory
{
    public function create(int $key, string $userName): User
    {
        return new User($key, $userName);
    }
}
