<?php

namespace App\Console\Commands;

use App\Jobs\NewTaskJob;
use App\Models\Task;
use Illuminate\Console\Command;

class DispatchNewTaskJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:dispatch-new-task-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch NewTaskJob for tasks that need to be processed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::where('status','=',1)->get();

        foreach ($tasks as $task) {
            NewTaskJob::dispatch($task);
        }

        $this->info('NewTaskJob dispatched for all pending tasks.');

        return 0;
    }
}
