<?php

namespace App\Providers;

use App\Repositories\CompaniesRepository;
use App\Repositories\Contracts\CompaniesRepositoryInterface;
use App\Repositories\Contracts\JobsRepositoryInterface;
use App\Repositories\Contracts\RoleUserRepositoryInterface;
use App\Repositories\Contracts\SalariesRepositoryInterface;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\UsersRepositoryInterface;
use App\Repositories\RoleUserRepository;
use App\Repositories\JobsRepository;
use App\Repositories\SalariesRepository;
use App\Repositories\UsersRepository;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CompaniesRepositoryInterface::class, CompaniesRepository::class);
        $this->app->bind(JobsRepositoryInterface::class, JobsRepository::class);
        $this->app->bind(SalariesRepositoryInterface::class, SalariesRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(RoleUserRepositoryInterface::class, RoleUserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
