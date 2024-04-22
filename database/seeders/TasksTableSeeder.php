<?php

namespace Database\Seeders;

use App\Enums\PriorityEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $userIds = [];
        foreach (range(1, 100) as $index) {
            $userId = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userIds[] = $userId;
        }
        $taskIds = [];
        foreach (range(1, 1000005) as $index) {
            $createdBy = $faker->randomElement($userIds);

            $taskId = DB::table('tasks')->insertGetId([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'priority' => $faker->randomElement([PriorityEnum::Low, PriorityEnum::Middle, PriorityEnum::High]),
                'start_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'end_date' => $faker->dateTimeBetween('now', '+1 year'),
                'status' => $faker->randomElement([StatusEnum::Pending, StatusEnum::in_progress, StatusEnum::Done]),
                'created_by' => $createdBy,
                'created_at' => $faker->dateTimeThisYear,
                'updated_at' => $faker->dateTimeThisYear,
            ]);
            $taskIds[] = $taskId;
         
        }
        $ids = [];
        foreach (range(1, 100) as $index) {
            $user_id = $faker->randomElement($userIds);
            $task_id = $faker->randomElement($taskIds);
            $taskUsers =DB::table('task_user')->insert([
                'task_id' => $task_id,
                'user_id' => $user_id
            ]);
            $ids[] = $taskUsers;
        }


    }
}
