<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Category;
use App\Entities\Todo;
use App\Repositories\TodoRepositoryInterface;
use DateTime;

final class TodoService implements TodoServiceInterface
{
    /**
     * @var \App\Repositories\TodoRepositoryInterface
     */
    private $todoRepository;

    /**
     * TodoService constructor.
     *
     * @param \App\Repositories\TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

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
    public function create(array $data, Category $category): Todo
    {
        $todo =
            (new Todo())
                ->setName($data['name'])
                ->setDescription($data['description'] ?? null)
                ->setCategory($category)
                ->setDeadline(new DateTime($data['deadline']))
                ->setStatus(self::STATUS_NEW);

        $this->todoRepository->saveAndFlush($todo);

        return $todo;
    }
}
