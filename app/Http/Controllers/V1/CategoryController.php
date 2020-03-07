<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\CategoryServiceInterface;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class CategoryController extends Controller
{
    /**
     * @var \App\Services\CategoryServiceInterface
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     *
     * @param \App\Services\CategoryServiceInterface $categoryService
     * @param \Illuminate\Contracts\Validation\Factory $validator
     */
    public function __construct(CategoryServiceInterface $categoryService, Factory $validator)
    {
        parent::__construct($validator);

        $this->categoryService = $categoryService;
    }

    /**
     * Create new Category.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    public function create(Request $request): Response
    {
        $this->validateRequest($request->input(), $this->getCreateRules());

        $category = $this->categoryService->create($request->input());

        return new Response($category->toArray(), 201);
    }

    /**
     * Delete Category.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \KamranAhmed\Faulty\Exceptions\HttpException
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    public function delete(string $id): Response
    {
        $this->categoryService->delete($id);

        return new Response('', 204);
    }

    /**
     * List Categories.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    public function list(Request $request): Response
    {
        $this->validateRequest($request->input(), $this->getListRules());

        $result = $this->categoryService->list($request->input());

        return new Response($result);
    }

    /**
     * Show Category.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    public function show(string $id): Response
    {
        return new Response($this->categoryService->show($id)->toArray());
    }

    /**
     * Update Category.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    public function update(Request $request, string $id): Response
    {
        $this->validateRequest($request->input(), $this->getUpdateRules());

        $todo = $this->categoryService->update($request->input(), $id);

        return new Response($todo->toArray());
    }

    /**
     * Create rules.
     *
     * @return string[]
     */
    private function getCreateRules(): array
    {
        return [
            'name' => 'required|string|max:60',
        ];
    }

    /**
     * List rules.
     *
     * @return string[]
     */
    private function getListRules(): array
    {
        return [];
    }

    /**
     * Update rules.
     *
     * @return string[]
     */
    private function getUpdateRules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:60',
        ];
    }
}
