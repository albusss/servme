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
     * @var string[]
     */
    private const CREATE_RULES = [
        'name' => 'required|string|max:60',
        'description' => 'sometimes|required|string|max:255',
        'deadline' => 'required|date|after:now',
        'category' => 'required|string',
    ];

    /**
     * @var string[]
     */
    private const UPDATE_RULES = [
        'name' => 'sometimes|required|string|max:60',
        'description' => 'sometimes|required|string|max:255',
        'deadline' => 'sometimes|required|date|after:now',
        'category' => 'sometimes|required|string',
        'status' => 'sometimes|required|string',
    ];

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
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    public function create(
        Request $request,
        CategoryServiceInterface $categoryService
    ): Response {
        $this->validateRequest($request->input(), self::CREATE_RULES);

        $category = $categoryService->retrieveOrcreate($request->input('category'));

        $todo = $this->todoService->create($request->input(), $category);

        return new Response($todo->toArray(), 201);
    }

    /**
     * Show entity.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $id): Response
    {
        return new Response($this->todoService->show($id)->toArray());
    }
}
