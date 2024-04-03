<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function __construct(
        public DashboardService $dashboardService
    )
    {}

    public function index() : View
    { 
        $todoTasks = $this->dashboardService->tasks('to-do');
        $doingTasks = $this->dashboardService->tasks('doing');
        $doneTasks = $this->dashboardService->tasks('done');

        return view('dashboard', [
            'todoTasks' => $todoTasks,
            'doingTasks' => $doingTasks,
            'doneTasks' => $doneTasks
        ]);
    }

    public function tasks(Request $request) : Collection
    {
        $request->validate([
            'status' => ['required', Rule::in(['to-do', 'doing', 'done'])]
        ]);

        $status = $request->status;

        return $this->dashboardService->tasks($status);
    }

    public function saveTask(Request $request) : Response
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        $id = $request->id;
        $this->dashboardService->saveTask($request->input(), $id);
 
        return response(true);
    }

    public function updateStatusTask(Request $request) : Response
    {
        $request->validate([
            'id' => ['required', 'int', 'exists:tasks,id'],
            'status' => ['required', Rule::in(['to-do', 'doing', 'done'])]
        ]);

        $id = $request->id;
        $status = $request->status;

        $this->dashboardService->updateStatusTask($id, $status);

        return response(true);
    }

    public function deleteTask(Request $request) : Response
    {
        $request->validate([
            'id' => ['required', 'exists:tasks,id']
        ]);

        $id = $request->id;
        $this->dashboardService->deleteTask($id);

        return response(true);
    }
}
