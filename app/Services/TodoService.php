<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Todo;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\TodoRepositoryInterface;
use DateTime;
use Illuminate\Contracts\Auth\Guard;
use KamranAhmed\Faulty\Exceptions\HttpException;
use KamranAhmed\Faulty\Exceptions\NotFoundException;

final class TodoService implements TodoServiceInterface
{
    /**
     * @var \App\Repositories\CategoryRepositoryInterface
     */
    private $categoryRepository;

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
     * @param \App\Repositories\CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        TodoRepositoryInterface $todoRepository,
        Guard $auth,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->todoRepository = $todoRepository;
        $this->currentUser = $auth->user();
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Todo
    {
        /** @var \App\Entities\Category $category */
        $category = $this->categoryRepository->findOneBy(['name' => $data['category']]);

        $todo =
            (new Todo())
                ->setName($data['name'])
                ->setUser($this->currentUser)
                ->setDescription($data['description'] ?? null)
                ->setCategory($category)
                ->setDeadline(new DateTime($data['deadline']))
                ->setCreatedAt(new DateTime())
                ->setStatus(self::STATUS_NEW);

        $this->todoRepository->saveAndFlush($todo);

        return $todo;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $id): void
    {
        $todo = $this->findTodoOrFail($id);

        try {
            $this->todoRepository->remove($todo);
        } catch (\Exception $exception) {
            throw new HttpException('Can not remove entity', 500, "Entity id [{$id}]");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function list(array $criteries): array
    {
        if (isset($criteries['category'])) {
            $criteries['category'] = $this->categoryRepository->findOneBy(['name' => $criteries['category']]);
        }

        $result = $this->todoRepository->findByCriteria($criteries);

        $response = [];
        foreach ($result as $item) {
            $response[] = $item->toArray();
        }

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function show(string $id): Todo
    {
        return $this->findTodoOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update(array $data, string $id): Todo
    {
        $todo = $this->findTodoOrFail($id);

        if (isset($data['category'])) {
            $data['category'] = $this->categoryRepository->findOneBy(['name' => $data['category']]);
        }

        $deadline = isset($data['deadline']) ? new DateTime($data['deadline']) : $todo->getDeadline();
        $todo
            ->setName($data['name'] ?? $todo->getName())
            ->setCategory($data['category'] ?? $todo->getCategory())
            ->setDescription($data['description'] ?? $todo->getDescription())
            ->setDeadline($deadline)
            ->setStatus($data['status'] ?? $todo->getStatus())
            ->setUpdatedAt(new DateTime());

        $this->todoRepository->saveAndFlush($todo);

        return $todo;
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
