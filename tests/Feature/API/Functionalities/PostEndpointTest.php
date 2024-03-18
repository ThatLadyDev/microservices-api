<?php

use App\Enums\TasksEnum;
use App\Jobs\ProcessTasksJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);

// Green Phase:

// Workflow:
//     1. Make request to the POST endpoint
//     2. The endpoint validates entries passed to it
//     3. On successful validation, create a queue
//     4. add a mock result action to this queue
test('mock result action is added to queue', function () {
    $requestData = [
        'text' => $this->faker->word,
        'tasks' => [array_rand(['call_reason', 'call_actions', 'satisfaction', 'call_segments', 'summary'])],
    ];

    // Validate the received text against a predefined maximum length.
    $maxLength = 30;

    $validator = Validator::make($requestData, [
        'text' => 'required|string|max:' . $maxLength,
        'tasks.*' => 'in:' . implode(',', TasksEnum::toArray()),
    ],[
        'tasks.*.in' => 'One or more tasks are invalid.',
    ]);

    $this->assertTrue($validator->fails());
    $this->assertEquals('One or more tasks are invalid.', $validator->errors()->first());

    $actions = [
        'call_reason' => ['Log reason', 'Document purpose', 'Note reason'],
        'call_actions' => ['Assign tasks', 'Note actions', 'Schedule follow-ups'],
        'satisfaction' => ['Send survey', 'Confirm satisfaction', 'Log feedback'],
        'call_segments' => ['Summarize points', 'Segment notes', 'Task segments'],
        'summary' => ['Document overview', 'Brief summary', 'Capture highlights']
    ];

    Queue::fake();

    $selectedAction = array_rand($actions);
    $selectedResultActionKey = array_rand($actions[$selectedAction]);
    $selectedResultAction = $actions[$selectedAction][$selectedResultActionKey];

    dispatch(new ProcessTasksJob($selectedResultAction));

    // Assert that the job was pushed onto the queue
    Queue::assertPushed(ProcessTasksJob::class);

    // $response = $this->postJson('api-endpoint', $requestData);

    // $response->assertStatus(200)->assertJsonFragment([
    //     'success' => true,
    //     'message' => 'Mock result action added to a queue'
    // ]);
});

// Green Phase:
// test('job ID is returned after mock result action is added to queue', function () {
//     // On successful validation, add a mock result action to a queue and return a Job ID.

//     // $requestData = [
//     // $response->assertStatus(200)
//     //     ->assertJsonFragment([
//     //         'success' => true,
//     //         'message' => 'Mock result action added to a queue',
//     //         'job_id' => 70 //Job ID is returned in this instance
//     //     ]); 
// });
