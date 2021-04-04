<?php

declare(strict_types=1);

namespace App\Entities;

use Serializable;

final class User implements Serializable
{
    private int $key;
    private string $userName;

    public function __construct(int $key, string $userName)
    {
        $this->key = $key;
        $this->userName = $userName;
    }

    public function getKey(): int
    {
        return $this->key;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function serialize(): string
    {
        return json_encode(
            [
                'key' => $this->key,
                'userName' => $this->userName,
            ],
            JSON_THROW_ON_ERROR
        );
    }

    public function unserialize($serialized): void
    {
        $decoded = json_decode($serialized);

        $this->key = $decoded->key;
        $this->userName = $decoded->userName;
    }
}
