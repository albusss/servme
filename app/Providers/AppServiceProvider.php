<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\CategoryServiceInterface;
use App\Services\TodoService;
use App\Services\TodoServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TodoServiceInterface::class, TodoService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }
}
