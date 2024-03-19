<?php

use App\Enums\TasksEnum;
use App\Jobs\ProcessTasksJob;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(WithFaker::class, RefreshDatabase::class);

// Refactor Phase:
test('that mock result action is added to queue', function () {
    Queue::fake(); // Fake the queue

    $tasks = TasksEnum::toArray();

    $requestData = [
        'text' => $this->faker->word,
        'tasks' => [Arr::random($tasks)],
    ];

    $response = $this->postJson('/api/perform-tasks', $requestData);

    // Assert that the TestJob was dispatched to the queue
    Queue::assertPushed(ProcessTasksJob::class);

    $response->assertStatus(200)->assertValid()->assertJsonFragment([
        'success' => true,
        'message' => 'Mock result action added to a queue'
    ]);
});

// Refactor Phase
test('that processed task job is stored in the database', function () {
    $jobId = null;
    Queue::fake(); // Fake the queue

    $tasks = TasksEnum::toArray();

    $requestData = [
        'text' => $this->faker->word,
        'tasks' => [Arr::random($tasks)],
    ];

    $response = $this->postJson('/api/perform-tasks', $requestData);

    // Assert that the TestJob was dispatched to the queue
    Queue::assertPushed(ProcessTasksJob::class);

    foreach ($requestData['tasks'] as $task) {
        # code...
        $this->assertDatabaseHas('processed_tasks', [
            'text' => $requestData['text'],
            'title' => $task,
        ]);
    }

    $response->assertStatus(200)
    ->assertValid()
    ->assertJsonFragment([
        'success' => true,
        'message' => 'Mock result action added to a queue'
    ]);
});