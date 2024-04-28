<?php

namespace App\Repository;

use App\Jobs\EditTaskJob;
use App\Jobs\NewTaskJob;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface {

    public function GetAllTasks()
    {
        // return Cache::remember('tasks',60,function() {
            $tasks = Task::with('users')->TaskStatus()
            ->latest()
            ->select('id','title','status','priority','start_date','end_date')
            ->paginate(50); 
        // });
        return $tasks;
    }
    public function GetAllUsers()
    {
        return Cache::remember('users',60,function() {
            return User::latest()->select('name')->get(); 
        });
    }
    public function StoreTask($request)
    {
        // DB::beginTransaction();
        try{
            $task = auth()->user()->tasksCreated()->create($request->safe()->all());
            
            $task->users()->attach($request->users);

            NewTaskJob::dispatch($task);
            
            // DB::commit();
            return redirect()->route('tasks.index');
        }
        catch (\Exception $e) {

            // DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        
    }
    

    public function UpdateTask($request,$task)
    {
        // DB::beginTransaction();
        try{
            $task->update($request->safe()->all());

            $task->users()->sync($request->input('users')); 

            EditTaskJob::dispatch($task);

            // DB::commit();

            return redirect()->route('tasks.index'); 
        }
        catch (\Exception $e) {
            // DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        } 
    }

    public function DeleteTask($task)
    {
        abort_if(auth()->user()->cannot('delete', $task), 403);

        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function SaveStatus($request,$task)
    {
        abort_if(auth()->user()->cannot('saveStatus', $task), 403);

        $task->update([
            'status' => $request->status
        ]);
        return redirect()->route('tasks.index');
    }

    public function ShowDetails($taskID)
    {
        return Task::with('comments', 'attachments')->findOrFail($taskID);
      
    }

    public function Search($request)
    {
        $tasks = Task::whereHas('users', function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        })
        ->orWhere('title', 'LIKE', '%' . $request->keyword . '%')
        ->orWhere('priority', $request->priority)
        ->orWhere('status', $request->status)
        ->orderBy('id', 'desc')
        ->get();
        
        return $tasks;

        //in laravel 10.47
        // $tasks = Task::whereAny(['title','priority','status'], 'LIKE', '%$request->search%')->get();

    }
    public function TaskComplected()
    {
        return Task::with('users')->where('status','=',3)->latest()->get();
    }

}