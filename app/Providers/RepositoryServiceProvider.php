<?php
declare(strict_types=1);

namespace App\Providers;

use App\Entities\Category;
use App\Entities\Todo;
use App\Entities\User;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\TodoRepository;
use App\Repositories\TodoRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register rpositories.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TodoRepositoryInterface::class, static function ($app) {
            return new TodoRepository(
                $app['em'],
                $app['em']->getClassMetaData(Todo::class)
            );
        });

        $this->app->bind(CategoryRepositoryInterface::class, static function ($app) {
            return new CategoryRepository(
                $app['em'],
                $app['em']->getClassMetaData(Category::class)
            );
        });

        $this->app->bind(UserRepositoryInterface::class, static function ($app) {
            return new UserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
            );
        });
    }
}
