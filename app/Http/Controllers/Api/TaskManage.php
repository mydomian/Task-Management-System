<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Controllers\Controller;

class TaskManage extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index(Request $request)
    {
        $filters = [
            'status' => $request->status,
            'sort' => $request->sort,
        ];
        return response()->json(['tasks' => $this->taskService->getAllTasksWithFilters($filters),],200);
    }
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Task created successfully',
            'task' => $this->taskService->createTask($request)
        ],201);
    }
    public function show(Task $task)
    {
        return response()->json(['task' => $task,],200);
    }
    public function update(Request $request, string $id)
    {
        return response()->json([
            'message' => 'Task updated successfully',
             'task' => $this->taskService->updateTask($request, $id)
        ], 200);
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
