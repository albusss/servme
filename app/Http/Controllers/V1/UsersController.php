<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\UserServiceInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KamranAhmed\Faulty\Exceptions\BadRequestException;
use KamranAhmed\Faulty\Exceptions\UnauthorizedException;

final class UsersController extends Controller
{
    /**
     * Login.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @param \App\Services\UserServiceInterface $userService
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    public function login(Request $request, UserServiceInterface $userService): Response
    {
        $this->validateRequest($request->input(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = $userService->login($request->input());

        if ($user === null) {
            throw new BadRequestException('Email or password is invalid', 'The given data was invalid.');
        }

        return new Response(
            [
                'email' => $user->getEmail(),
                'apiKey' => $user->getApiKey(),
            ],
            200
        );
    }

    /**
     * Logout.
     *
     * @param \App\Services\UserServiceInterface $userService
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\UnauthorizedException
     */
    public function logout(UserServiceInterface $userService, Guard $auth): Response
    {
        if ($auth->user() === null) {
            throw new UnauthorizedException('You are not authorized');
        }

        $userService->logout();

        return new Response('', 204);
    }

    /**
     * Registers a new User.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @param \App\Services\UserServiceInterface $userService
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    public function register(Request $request, UserServiceInterface $userService): Response
    {
        $this->validateRequest($request->input(), $this->getCreateRules());

        $user = $userService->create($request->input());

        return new Response($user->toArray(), 201);
    }

    /**
     * Create rules.
     *
     * @return string[]
     */
    private function getCreateRules(): array
    {
        return [
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'gender' => 'required|string',
            'birthday' => 'required|date',
            'email' => 'required|email',
            'password' => 'required|alpha_dash|min:8',
        ];
    }
}
