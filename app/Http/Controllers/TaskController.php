<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Task;

class TaskController extends Controller
{
    /**
     * @var TaskRepository
     */
    protected $tasks;

    /*
     * Authenticating All Task Routes
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    /*
     * GET /tasks
     */
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /*
     * POST /tasks
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /*
     * DELETE /tasks/{id}
     */
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }
}
