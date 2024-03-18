<?php

use App\Enums\TasksEnum;
use App\Jobs\ProcessTasksJob;
use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);

// Refactor Phase:
test('that mock result action is added to queue', function () {
    Queue::fake(); // Fake the queue

    $tasks = TasksEnum::toArray();

    $requestData = [
        'text' => $this->faker->word,
        'tasks' => [Arr::random($tasks)],
    ];

    $response = $this->postJson('/api/perform-tasks', $requestData);

    $response->assertStatus(200)->assertValid()->assertJsonFragment([
        'success' => true,
        'message' => 'Mock result action added to a queue'
    ]);

    // Assert that the TestJob was dispatched to the queue
    Queue::assertPushed(ProcessTasksJob::class);
});
