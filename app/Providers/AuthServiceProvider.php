<?php

namespace App\Providers;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Boot the authentication services for the application.
     *
     * @param \App\Repositories\UserRepositoryInterface $repository
     *
     * @return void
     */
    public function boot(UserRepositoryInterface $repository)
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) use ($repository) {
            if ($request->header('Authorization')) {
                $key = \explode(' ', $request->header('Authorization'));
                /** @var \App\Entities\User $user */
                $user = $repository->findOneBy(['apiKey' => $key[1]]);
                if ($user !== null) {
                    $request->request->add(['userId' => $user->getId()]);
                }

                return $user;
            }

            return null;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
