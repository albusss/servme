<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\CategoryServiceInterface;
use App\Services\TodoServiceInterface;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class TodoController extends Controller
{
    /**
     * @var \App\Services\TodoServiceInterface
     */
    private $todoService;

    /**
     * TodoController constructor.
     *
     * @param \App\Services\TodoServiceInterface $todoService
     * @param \Illuminate\Contracts\Validation\Factory $validator
     */
    public function __construct(TodoServiceInterface $todoService, Factory $validator)
    {
        parent::__construct($validator);

        $this->todoService = $todoService;
    }

    /**
     * Create new entity.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\CategoryServiceInterface $categoryService
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    public function create(
        Request $request,
        CategoryServiceInterface $categoryService
    ): Response {
        $this->validateRequest($request->input(), $this->getCreateRules());

        $category = $categoryService->retrieveOrcreate($request->input('category'));

        $todo = $this->todoService->create($request->input(), $category);

        return new Response($todo->toArray(), 201);
    }

    /**
     * Delete entity.
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
        $this->todoService->delete($id);

        return new Response('', 204);
    }

    /**
     * Show entity.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \KamranAhmed\Faulty\Exceptions\NotFoundException
     */
    public function show(string $id): Response
    {
        return new Response($this->todoService->show($id)->toArray());
    }

    /**
     * Update Entity.
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

        $todo = $this->todoService->update($request->input(), $id);

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
            'description' => 'sometimes|required|string|max:255',
            'deadline' => 'required|date|after:now',
            'category' => 'required|string',
        ];
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
            'description' => 'sometimes|required|string|max:255',
            'deadline' => 'sometimes|required|date|after:now',
            'status' => 'sometimes|required|string|in:' . \implode(',', TodoServiceInterface::ALL_STATUSES),
        ];
    }
}
