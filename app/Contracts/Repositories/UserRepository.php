<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Entities\User;
use Illuminate\Support\Collection;

interface UserRepository
{
    /** Collection|User[] */
    public function all(): Collection;

    public function find(int $id): User;

    public function save(User $user): void;
}
