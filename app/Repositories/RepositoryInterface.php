<?php
declare(strict_types=1);

namespace App\Repositories;

use Doctrine\Persistence\ObjectRepository;

interface RepositoryInterface extends ObjectRepository
{
    /**
     * Removes entity.
     *
     * @param $object
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove($object): void;

    /**
     * Saves and flushes Entity.
     *
     * @param $object
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveAndFlush($object): void;
}
