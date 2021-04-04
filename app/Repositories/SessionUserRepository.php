<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository;
use App\Entities\User;
use App\Exceptions\UserNotFoundException;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store as Storage;
use Illuminate\Support\Collection;

final class SessionUserRepository implements UserRepository
{
    private Storage $storage;

    public function __construct(SessionManager $sessionManager)
    {
        $this->storage = $sessionManager->driver();
    }

    public function all(): Collection
    {
        $usersArray = $this->storage->get('users', []);

        $users = array_map(
            static function ($user): User {
                return unserialize($user, [User::class]);
            },
            $usersArray
        );

        return new Collection($users);
    }

    /** @throws UserNotFoundException */
    public function find(int $id): User
    {
        $users = $this->all();
        $user = $users->get($id);

        if (!$user instanceof User) {
            throw  new UserNotFoundException();
        }

        return $user;
    }

    public function save(User $user): void
    {
        $users = $this->all();
        $users->put($user->getKey(), $user);

        $usersArray = $users->map(
            static function ($user): string {
                return serialize($user);
            },
        )->toArray();

        $this->storage->put('users', $usersArray);
    }
}
