<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Category;
use App\Entities\Todo;

interface TodoServiceInterface
{
    /**
     * @var string[]
     */
    public const ALL_STATUSES = [
        self::STATUS_COMPLETED,
        self::STATUS_NEW,
        self::STATUS_OVERDUE,
        self::STATUS_SNOOZED,
    ];

    /**
     * @var string
     */
    public const STATUS_COMPLETED = 'completed';

    /**
     * @var string
     */
    public const STATUS_NEW = 'new';

    /**
     * @var string
     */
    public const STATUS_OVERDUE = 'overdue';

    /**
     * @var string
     */
    public const STATUS_SNOOZED = 'snoozed';

    /**
     * Create new entity.
     *
     * @param mixed[] $data
     * @param \App\Entities\Category $category
     *
     * @return \App\Entities\Todo
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function create(array $data, Category $category): Todo;

    /**
     * Show entity.
     *
     * @param string $id
     *
     * @return \App\Entities\Todo
     *
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    public function show(string $id): Todo;
}
