<?php
declare(strict_types=1);

namespace App\Repositories;

interface TodoRepositoryInterface extends RepositoryInterface
{
    /**
     * Find by criteria.
     *
     * @param mixed[] $criteria
     *
     * @return \App\Entities\Todo[]
     *
     * @throws \Exception
     */
    public function findByCriteria(array $criteria);
}
