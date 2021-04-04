<?php

namespace App\Providers;

use App\Contracts\Repositories\UserRepository;
use App\Repositories\SessionUserRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    public $singletons = [
        UserRepository::class => SessionUserRepository::class,
    ];

    public function register()
    {
        foreach ($this->singletons as $key => $value) {
            $this->app->singleton($key, $value);
        }
    }
}
