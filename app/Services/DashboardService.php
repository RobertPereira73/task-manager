<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function tasks(string $status) : Collection
    {
        return Task::where('status', $status)
            ->orderByDesc('created_at')
            ->get();
    }

    public function saveTask(array $fields, int $id=null) : Task
    {
        $task = Task::updateOrCreate(['id' => $id], $fields);
        return $task;
    }

    public function updateStatusTask(int $id, string $status) : void
    {
        $task = Task::find($id);
        $task->status = $status;
        $task->save();
    }

    public function deleteTask(int $id) : void
    {
        Task::where('id', $id)->delete();
    }
}
