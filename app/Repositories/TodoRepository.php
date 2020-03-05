<?php
declare(strict_types=1);

namespace App\Repositories;

final class TodoRepository extends AbstractRepository implements TodoRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findByCriteria(array $criteria): array
    {
        $queryBuilder = $this->createQueryBuilder('t');

        if (isset($criteria['deadline'])) {
            $queryBuilder->andWhere($queryBuilder->expr()->gte('t.deadline', ':deadline'));
            $queryBuilder->setParameter('deadline', $criteria['deadline']);
        }

        if (isset($criteria['category'])) {
            $queryBuilder->andWhere($queryBuilder->expr()->eq('t.category', ':category'));
            $queryBuilder->setParameter('category', $criteria['category']);
        }

        if (isset($criteria['status'])) {
            $queryBuilder->andWhere($queryBuilder->expr()->eq('t.status', ':status'));
            $queryBuilder->setParameter('status', $criteria['status']);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
