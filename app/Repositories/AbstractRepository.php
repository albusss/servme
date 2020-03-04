<?php
declare(strict_types=1);

namespace App\Repositories;

use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function remove($object): void
    {
        $this->getEntityManager()->remove($object);
        $this->getEntityManager()->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function saveAndFlush($object): void
    {
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush();
    }
}
