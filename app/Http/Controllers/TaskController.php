<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
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
        $tasks = $this->taskService->getAllTasksWithFilters($filters);
        return view('task.index',compact('tasks'));
    }
    public function create()
    {
        // Note: For create i am using a Task Add modal
    }
    public function store(Request $request)
    {
        $this->taskService->createTask($request);
        return redirect()->route('tasks.index')->with('success','Task Added Successfully');
    }
    public function show(string $id)
    {
      // Note: For show i am using a Task show modal
    }
    public function edit(string $id)
    {
        // Note: For edit i am using a Task edit modal
    }
    public function update(Request $request, string $id)
    {
        $this->taskService->updateTask($request, $id);
        return redirect()->route('tasks.index')->with('success','Task Updated Successfully');
    }
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('warning', 'Task deleted successfully!');
    }
}
