<?php

namespace App\Providers;

use App\Domain\Repositories\GameResultRepositoryInterface;
use App\Domain\Repositories\LinkRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\EloquentGameResultRepository;
use App\Infrastructure\Repositories\EloquentLinkRepository;
use App\Infrastructure\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(LinkRepositoryInterface::class, EloquentLinkRepository::class);
        $this->app->bind(GameResultRepositoryInterface::class, EloquentGameResultRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
