<?php
declare(strict_types=1);

namespace App\Tests\Functional\Http\Controllers\V1;

use App\Entities\Category;
use App\Entities\User;
use App\Tests\TestCase;

final class CategoryControllerTest extends TestCase
{
    /**
     * Test create Todo.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testCreate(): void
    {
        $deadline = new \DateTime('+1 day');
        /** @var \App\Entities\User $user */
        $user = \entity(User::class)->create();
        /** @var \App\Entities\Category $category */
        $category = \entity(Category::class)->create();
        $data = [
            'name' => 'name',
            'deadline' => $deadline->format(\DateTimeInterface::ATOM),
            'category' => $category->getName(),
        ];
        $headers = ['Authorization' => 'Bearer ' . $user->getApiKey()];

        $this->json('POST', '/api/v1/todos', $data, $headers);

        $this->seeJsonContains([
            'name' => 'name',
            'deadline' => $deadline->format(\DateTimeInterface::ATOM),
            'category' => $category->getId(),
        ]);
    }
}
