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

    public function create(array $data, Category $category): Todo;
}
