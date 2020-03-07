<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\User;

interface UserServiceInterface
{
    /**
     * Creates new User.
     *
     * @param mixed[] $inputData
     *
     * @return \App\Entities\User
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function create(array $inputData): User;

    /**
     * Login.
     *
     * @param mixed[] $input
     *
     * @return \App\Entities\User
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function login(array $input): ?User;

    /**
     * Logout.
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function logout(): void;
}
