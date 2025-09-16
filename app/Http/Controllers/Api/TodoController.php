<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Resources\TodoResource;
use App\Services\TodoService;
use App\Helpers\ApiResponse;

class TodoController extends Controller
{
     protected TodoService $todoService;
    public function __construct(TodoService $todoService) { $this->todoService = $todoService; }

    public function store(StoreTodoRequest $request) {
        $todo = $this->todoService->create($request->validated());
        return ApiResponse::success(new TodoResource($todo), 'Todo created', 201);
    }
}
