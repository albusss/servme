<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepositoryInterface;
use DateTime;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserService implements UserServiceInterface
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    private $auth;

    /**
     * @var \App\Repositories\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     *
     * @param \App\Repositories\UserRepositoryInterface $userRepository
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(UserRepositoryInterface $userRepository, Guard $auth)
    {
        $this->userRepository = $userRepository;
        $this->auth = $auth;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $inputData): User
    {
        $user =
            (new User())
                ->setFirstName($inputData['firstname'])
                ->setLastName($inputData['lastname'])
                ->setEmail($inputData['email'])
                ->setGender($inputData['gender'])
                ->setMobileNumber($inputData['mobile'])
                ->setBirthday(new DateTime($inputData['birthday']))
                ->setCreatedAt(new DateTime())
                ->setPassword(Hash::make($inputData['password']));

        $this->userRepository->saveAndFlush($user);

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function login(array $input): ?User
    {
        /** @var \App\Entities\User $user */
        $user = $this->userRepository->findOneBy(['email' => $input['email']]);

        if (Hash::check($input['password'], $user->getPassword())) {
            $apikey = \base64_encode(Str::random(40));
            $user->setApiKey($apikey);

            $this->userRepository->saveAndFlush($user);

            return $user;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function logout(): void
    {
        /** @var \App\Entities\User $user */
        $user = $this->auth->user();
        $user->setApiKey(null);

        $this->userRepository->saveAndFlush($user);
    }
}
