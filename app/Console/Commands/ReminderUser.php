<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Notifications\RemindUsersNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;


class ReminderUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reminder-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder User For Task';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereHas('tasks',function($query) {
            $query->TaskReminder();
        })->select('name','email')->get();

        Notification::send($users, new RemindUsersNotification());

    }
}
