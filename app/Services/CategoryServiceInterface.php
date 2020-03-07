<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Category;

interface CategoryServiceInterface
{
    /**
     * Create new Category.
     *
     * @param mixed[] $data
     *
     * @return \App\Entities\Category
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function create(array $data): Category;

    /**
     * Delete Category.
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
     * List Categories
     *
     * @param mixed[] $criteries
     *
     * @return \App\Entities\Category[]
     */
    public function list(array $criteries): array;

    /**
     * Show Category.
     *
     * @param string $id
     *
     * @return \App\Entities\Category
     *
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    public function show(string $id): Category;

    /**
     * Update Category.
     *
     * @param mixed[] $data
     * @param string $id
     *
     * @return \App\Entities\Category
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     * @throws \Exception
     */
    public function update(array $data, string $id): Category;
}
