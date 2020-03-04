<?php
declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\CategoryServiceInterface;
use App\Services\TodoServiceInterface;
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
     * Create new entity.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @param \App\Services\TodoServiceInterface $todoService
     *
     * @param \App\Services\CategoryServiceInterface $categoryService
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \KamranAhmed\Faulty\Exceptions\BadRequestException
     */
    public function create(
        Request $request,
        TodoServiceInterface $todoService,
        CategoryServiceInterface $categoryService
    ): Response {
        $this->validateRequest($request->input(), self::CREATE_RULES);

        $category = $categoryService->retrieveOrcreate($request->input('category'));

        $todo = $todoService->create($request->input(), $category);

        return new Response($todo->toArray(), 201);
    }
}
