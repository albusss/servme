<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Category;
use App\Entities\Todo;
use App\Repositories\TodoRepositoryInterface;
use DateTime;
use Illuminate\Contracts\Auth\Guard;
use KamranAhmed\Faulty\Exceptions\NotFoundException;

final class TodoService implements TodoServiceInterface
{
    /**
     * @var \App\Entities\User
     */
    private $currentUser;

    /**
     * @var \App\Repositories\TodoRepositoryInterface
     */
    private $todoRepository;

    /**
     * TodoService constructor.
     *
     * @param \App\Repositories\TodoRepositoryInterface $todoRepository
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(TodoRepositoryInterface $todoRepository, Guard $auth)
    {
        $this->todoRepository = $todoRepository;
        $this->currentUser = $auth->user();
    }

    /**
     * {@inheritdoc}
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

    /**
     * {@inheritdoc}
     */
    public function show(string $id): Todo
    {
        return $this->findTodoOrFail($id);
    }

    /**
     * Find entity by id.
     *
     * @param string $id
     *
     * @return \App\Entities\Todo
     *
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    private function findTodoOrFail(string $id): Todo
    {
        /** @var \App\Entities\Todo $todo */
        $todo = $this->todoRepository->findOneBy(['id' => $id, 'user' => $this->currentUser]);

        if ($todo === null) {
            throw new NotFoundException(
                "Todo id [{$id}]",
                'Entity is not found'
            );
        }

        return $todo;
    }
}
