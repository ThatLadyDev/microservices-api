<?php

use App\Enums\TasksEnum;
use App\Models\ProcessedJob;
use App\Jobs\ProcessTasksJob;
use App\Models\ProcessedTask;
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

    $response->assertStatus(200)->assertValid()->assertJsonFragment([
        'success' => true,
        'message' => 'Mock result action added to a queue'
    ]);

    // Assert that the TestJob was dispatched to the queue
    Queue::assertPushed(ProcessTasksJob::class);
});

// Green Phase
test('that processed task job is stored in the database', function () {
    $jobId = 50;
    $tasks = TasksEnum::toArray();
    $taskData = [
        'text' => $this->faker->word,
        'tasks' => [Arr::random($tasks)],
    ];

    $actions = [
        'call_reason' => ['Log reason', 'Document purpose', 'Note reason'],
        'call_actions' => ['Assign tasks', 'Note actions', 'Schedule follow-ups'],
        'satisfaction' => ['Send survey', 'Confirm satisfaction', 'Log feedback'],
        'call_segments' => ['Summarize points', 'Segment notes', 'Task segments'],
        'summary' => ['Document overview', 'Brief summary', 'Capture highlights']
    ];

    foreach ($taskData['tasks'] as $task) {
        # code...
        $taskUuid = Str::uuid();

        ProcessedJob::query()->create([
            'uuid' => Str::uuid(),
            'type' => 'task',
            'job_id' => $jobId,
            'metadata' => ['task-uuid' => $taskUuid]
        ]);

        ProcessedTask::query()->create([
            'uuid' => $taskUuid,
            'title' => $task,
            'text' => $taskData['text'],
            'action' => Arr::random($actions[$task]),
        ]);
    }
});