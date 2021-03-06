<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Entities\Category;
use App\Http\Controllers\Controller;
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
     * Create new Todo.
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

        $todo = $this->todoService->create($request->input());

        return new Response($todo->toArray(), 201);
    }

    /**
     * Delete Todo.
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
     * List Todos
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

        $result = $this->todoService->list($request->input());

        return new Response($result);
    }

    /**
     * Show Todo.
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
     * Update Todo.
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
        $categoryClass = Category::class;

        return [
            'name' => 'required|string|max:60',
            'description' => 'sometimes|required|string|max:255',
            'deadline' => 'required|date|after:now',
            'category' => "required|string|exists:{$categoryClass},name",
        ];
    }

    /**
     * List rules.
     *
     * @return string[]
     */
    private function getListRules(): array
    {
        $categoryClass = Category::class;

        return [
            'category' => "sometimes|required|string|exists:{$categoryClass},name",
            'period' => 'sometimes|required|string|in:day,month,all',
            'status' => 'sometimes|required|string|in:' . \implode(',', TodoServiceInterface::ALL_STATUSES),
        ];
    }

    /**
     * Update rules.
     *
     * @return string[]
     */
    private function getUpdateRules(): array
    {
        $categoryClass = Category::class;

        return [
            'category' => "sometimes|required|string|exists:{$categoryClass},name",
            'name' => 'sometimes|required|string|max:60',
            'description' => 'sometimes|required|string|max:255',
            'deadline' => 'sometimes|required|date|after:now',
            'status' => 'sometimes|required|string|in:' . \implode(',', TodoServiceInterface::ALL_STATUSES),
        ];
    }
}
