<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\Category;

interface CategoryServiceInterface
{
    /**
     * Retrieve or create Category.
     *
     * @param string $categoryName
     *
     * @return \App\Entities\Category
     */
    public function retrieveOrcreate(string $categoryName): Category;
}
