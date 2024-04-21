<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCreationTest extends TestCase
{
    // use RefreshDatabase;
    /** @test */
    public function a_task_can_be_created()
    {
        // $response = $this->post('/tasks', [
        //     'title' => 'Test Task',
        //     'description' => 'This is a test task.',
        //     'priority' => '3',
        //     'start_date' => now(),
        //     'end_date' => now()->addHour('1'),
        //     'status' => '1',
        //     'created_by' => '1',
        //     'assigned_to' => '2'
        // ]);

        // $response->assertStatus(201); // Assuming a 201 Created response
        // $this->assertDatabaseHas('tasks', [
        //     'title' => 'Test Task',
        //     'description' => 'This is a test task.',
        //     'priority' => '3',
        //     'start_date' => now(),
        //     'end_date' => now()->addHour('1'),
        //     'status' => '1',
        //     'created_by' => '1',
        //     'assigned_to' => '2'
        // ]);
        $user = User::factory()->create();
        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'priority' => '1', // Assuming PriorityEnum::High is 'high'
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'status' => '1', // Assuming StatusEnum::Pending is 'pending'
            'created_by' => $user->id,
            'assigned_to' => $user->id,
        ];

        // Make a POST request to the task creation endpoint
        $response = $this->post('/tasks', $taskData);

        // Assert the task was created successfully
        $response->assertStatus(201); // Assuming a 201 Created response
        $this->assertDatabaseHas('tasks', $taskData);
        
    }
}
