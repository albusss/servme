<?php
declare(strict_types=1);

namespace App\Tests\Unit\Services;

use App\Entities\User;
use App\Repositories\CategoryRepositoryInterface;
use App\Services\CategoryService;
use App\Services\CategoryServiceInterface;
use App\Tests\TestCase;
use Illuminate\Contracts\Auth\Guard;

final class CategoryServiceTest extends TestCase
{
    /**
     * Test create method.
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function testCreate(): void
    {
        $categoryName = 'name';
        $categoryService = $this->mockCategoryService();

        $actualResult = $categoryService->create(['name' => $categoryName]);

        self::assertSame($categoryName, $actualResult->getName());
    }

    /**
     * Mock of the CategoryRepositoryInterface.
     *
     * @return \App\Repositories\CategoryRepositoryInterface
     */
    private function mockCategoryRepository(): CategoryRepositoryInterface
    {
        $mock = $this->createMock(CategoryRepositoryInterface::class);

        $mock
            ->expects(self::once())
            ->method('saveAndFlush');

        return $mock;
    }

    /**
     * Create CategoryService.
     *
     * @return \App\Services\CategoryServiceInterface
     *
     * @throws \Exception
     */
    private function mockCategoryService(): CategoryServiceInterface
    {
        return new CategoryService(
            $this->mockCategoryRepository(),
            $this->mockGuard()
        );
    }

    /**
     * Mock of the Guard.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     *
     * @throws \Exception
     */
    private function mockGuard(): Guard
    {
        $mock = $this->createMock(Guard::class);

        $mock
            ->expects(self::once())
            ->method('user')
            ->willReturn(new User());

        return $mock;
    }
}
