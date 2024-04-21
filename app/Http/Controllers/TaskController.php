<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\EditTaskRequest;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Models\Task;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $Task;

    public function __construct(TaskRepositoryInterface $Task)
    {
        $this->Task = $Task;
    }
    public function index()
    {
        $tasks = $this->Task->getAllTasks();
        $users = $this->Task->GetAllUsers();
        return view('tasks.index', compact('tasks', 'users'));
    }

    
    public function create()
    {
        $users = $this->Task->GetAllUsers();
        return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        return $this->Task->StoreTask($request);
    }

    
    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        $users = $this->Task->GetAllUsers();
        return view('tasks.edit', compact('task','users'));
    }

    public function update(EditTaskRequest $request, Task $task)
    {
        return $this->Task->UpdateTask($request,$task);
    }

    public function destroy(Task $task)
    {
        return $this->Task->DeleteTask($task);
    }

    public function save_status(Request $request, Task $task)
    {
        return $this->Task->SaveStatus($request,$task);
    }
    
    public function show_details($taskID)
    {
        $task = $this->Task->ShowDetails($taskID);
        $users = $this->Task->GetAllUsers();
        return view('tasks.show', compact('task','users'));
    }
    
    public function search(Request $request)
    {
        $tasks = $this->Task->Search($request);
        $users = $this->Task->GetAllUsers();
        return view('tasks.index',compact('tasks','users'));

    }

    public function complected()
    {
        $tasks = $this->Task->TaskComplected();
        return view('tasks.index',compact('tasks'));
    }
}
