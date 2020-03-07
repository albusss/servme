<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Category;
use App\Repositories\CategoryRepositoryInterface;
use DateTime;
use Illuminate\Contracts\Auth\Guard;
use KamranAhmed\Faulty\Exceptions\HttpException;
use KamranAhmed\Faulty\Exceptions\NotFoundException;

final class CategoryService implements CategoryServiceInterface
{
    /**
     * @var \App\Repositories\CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    private $currentUser;

    /**
     * CategoryService constructor.
     *
     * @param \App\Repositories\CategoryRepositoryInterface $categoryRepository
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository, Guard $auth)
    {
        $this->categoryRepository = $categoryRepository;
        $this->currentUser = $auth->user();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): Category
    {
        $category =
            (new Category())
                ->setName($data['name'])
                ->setCreatedAt(new DateTime());

        $this->categoryRepository->saveAndFlush($category);

        return $category;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(string $id): void
    {
        $category = $this->findCategoryOrFail($id);

        try {
            $this->categoryRepository->remove($category);
        } catch (\Exception $exception) {
            throw new HttpException('Can not remove entity', 500, "Entity id [{$id}]");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function list(array $criteries): array
    {
    }

    /**
     * {@inheritdoc}
     */
    public function show(string $id): Category
    {
        return $this->findCategoryOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function update(array $data, string $id): Category
    {
        $category = $this->findCategoryOrFail($id);

        $category
            ->setName($data['name'] ?? $category->getName())
            ->setUpdatedAt(new DateTime());

        $this->categoryRepository->saveAndFlush($category);

        return $category;
    }

    /**
     * Find entity by id.
     *
     * @param string $id
     *
     * @return \App\Entities\Category
     *
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    private function findCategoryOrFail(string $id): Category
    {
        /** @var \App\Entities\Category $category */
        $category = $this->categoryRepository->findOneBy(['id' => $id, 'user' => $this->currentUser]);

        if ($category === null) {
            throw new NotFoundException(
                "Category id [{$id}]",
                'Entity is not found'
            );
        }

        return $category;
    }
}
