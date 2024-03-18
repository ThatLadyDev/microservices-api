<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;

// Red Phase:

// Workflow:
//     1. Make request to the POST endpoint
//     2. The endpoint validates entries passed to it
//     3. On successful validation, create a queue
//     4. add a mock result action to this queue
test('mock result action is added to queue', function () {
    $this->uses(WithFaker::class);
    $requestData = [
        'text' => $this->faker->word,
        'tasks' => [$this->faker->word, $this->faker->word, $this->faker->word],
    ];

    // This mocks the Queue facade to assert that the job is indeed dispatched
    Queue::fake();

    $response = $this->postJson('api-endpoint', $requestData);

    $response->assertStatus(200)->assertJsonFragment([
        'success' => true,
        'message' => 'Mock result action added to a queue'
    ]);

    // Assert that the job was dispatched to the queue
    Queue::assertPushed(\App\Jobs\ProcessTasks::class, function ($job) use ($taskData) {
        return $job->tasks === $taskData['tasks'];
    });
});

// Red Phase:
test('job ID is returned after mock result action is added to queue', function () {
    // On successful validation, add a mock result action to a queue and return a Job ID.

    $this->uses(WithFaker::class);
    $requestData = [
        'text' => $this->faker->word,
        'tasks' => [$this->faker->word, $this->faker->word, $this->faker->word],
    ];

    // This mocks the Queue facade to assert that the job is indeed dispatched
    Queue::fake();

    $response = $this->postJson('api-endpoint', $requestData);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Mock result action added to a queue',
            'job_id' => 70 //Job ID is returned in this instance
        ]); 

    // Assert that the job was dispatched to the queue
    Queue::assertPushed(\App\Jobs\ProcessTasks::class, function ($job) use ($taskData) {
        return $job->tasks === $taskData['tasks'];
    });
});
