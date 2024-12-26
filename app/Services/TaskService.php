<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Http\Request;

class TaskService
{
    public function getAllTasksWithFilters($filters)
    {
        try {
            $query = Task::query()->with('user')->where('user_id', Auth::id());
            if (!empty($filters['status'])) {
                $query->where('status', $filters['status']);
            }
            if (!empty($filters['sort'])) {
                if ($filters['sort'] === 'asc') {
                    $query->orderBy('due_date', 'asc');
                } elseif ($filters['sort'] === 'desc') {
                    $query->orderBy('due_date', 'desc');
                }
            }
            return $query->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function createTask($data)
    {
        try {
            $data->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'due_date' => 'required|date',
            ]);
            return Task::create([
                'user_id' => Auth::id(),
                'title' => $data->title,
                'description' => $data->description,
                'due_date' => $data->due_date,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function updateTask($data, $id)
    {
        try {
            $data->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'due_date' => 'required|date',
            ]);
            return Task::find($id)->update([
                'title' => $data->title,
                'description' => $data->description,
                'due_date' => $data->due_date,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
