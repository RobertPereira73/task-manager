<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class DashboardService
{
    public function tasks(int $userId, string $status) : Collection
    {
        return Task::where('user_id', $userId)
            ->where('status', $status)
            ->orderByDesc('created_at')
            ->get();
    }

    public function saveTask(int $userId, int $id=null, array $fields) : Task
    {
        $task = Task::updateOrCreate(['user_id' => $userId, 'id' => $id], $fields);
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
