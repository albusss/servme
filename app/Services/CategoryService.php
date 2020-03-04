<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Category;
use App\Repositories\CategoryRepositoryInterface;

final class CategoryService implements CategoryServiceInterface
{
    /**
     * @var \App\Repositories\CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * CategoryService constructor.
     *
     * @param \App\Repositories\CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveOrcreate(string $categoryName): Category
    {
        /** @var \App\Entities\Category $category */
        $category = $this->categoryRepository->findOneBy(['name' => $categoryName]);

        if ($category !== null) {
            return $category;
        }

        return (new Category())->setName($categoryName);
    }
}
