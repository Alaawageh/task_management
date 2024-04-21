<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskDeadLinesNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class TaskDeadLine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:task-deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task deadlines';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereHas('tasks',function($query) {
            $query->TaskDeadline();
        })->select('name','email')->get();
       
        Notification::send($users, new TaskDeadLinesNotification());
        
    }
}
