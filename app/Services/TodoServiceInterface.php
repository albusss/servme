<?php
declare(strict_types=1);

namespace App\Services;

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
     *
     * @return \App\Entities\Todo
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function create(array $data): Todo;

    /**
     * Delete entity.
     *
     * @param string $id
     *
     * @return void
     *
     * @throws \KamranAhmed\Faulty\Exceptions\HttpException
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    public function delete(string $id): void;

    /**
     * List Todos
     *
     * @param mixed[] $criteries
     *
     * @return \App\Entities\Todo[]
     *
     * @throws \Exception
     */
    public function list(array $criteries): array;

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

    /**
     * Update Entity.
     *
     * @param mixed[] $data
     * @param string $id
     *
     * @return \App\Entities\Todo
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     * @throws \Exception
     */
    public function update(array $data, string $id): Todo;
}
