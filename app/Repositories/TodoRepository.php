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

        if (isset($criteria['period']) && $criteria['period'] !== 'all') {
            $queryBuilder->andWhere($queryBuilder->expr()->lt('t.deadline', ':deadline'));
            $queryBuilder->setParameter('deadline', $this->calculatePeriod($criteria['period']));
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

    /**
     * Calculate period.
     *
     * @param string $period
     *
     * @return string
     *
     * @throws \Exception
     */
    private function calculatePeriod(string $period): string
    {
        if ($period === 'day') {
            return (new \DateTime('+1 day'))->format('Y-m-d');
        }
        if ($period === 'month') {
            return (new \DateTime('+1 month'))->format('Y-m-d');
        }
    }
}
