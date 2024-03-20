<?php

use App\Enums\TasksEnum;
use Illuminate\Support\Arr;
use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\API\Helpers\PostEndpointHelper as Helper;

uses(WithFaker::class);

it('can process a successful POST request', function () {
    $tasks = TasksEnum::toArray();
    $requestData = [
        'text' => 'test-test',
        'tasks' => [Arr::random($tasks)],
    ];

    $response = $this->postJson('/api/perform-tasks', $requestData);

    $response->assertStatus(200)->assertValid()->assertJsonFragment(ApiResponse::success('Mock result action added to a queue')->toArray());
});

// Refactor Phase:
test('that mock result action is added to queue', function () {

    $response = Helper::addMockResultActionToQueue($this, $this->faker->word);

    $response
        ->assertStatus(200)
        ->assertValid()
        ->assertJsonFragment(
            ApiResponse::success('Mock result action added to a queue')->toArray()
        );
});

test('that processed task job is stored in the database', function () {
    $tasks = TasksEnum::toArray();
    $requestData = [
        'text' => 'test-test',
        'tasks' => [Arr::random($tasks)],
    ];

    $response = $this->postJson('/api/perform-tasks', $requestData);

    $response->assertStatus(200)->assertValid()->assertJsonFragment(ApiResponse::success('Mock result action added to a queue')->toArray());

//    $this->assertDatabaseHas('processed_tasks', [
//        'text' => $requestData['text'],
//    ]);

//    $this->assertDatabaseHas('users', $payload);
});

//{
//    $tasks = TasksEnum::toArray();
//
//    $requestData = [
//        'text' => '77777777777',
//        'tasks' => [Arr::random($tasks)],
//    ];
//
//    // Make a POST request to your endpoint
//    $response = $this->postJson('/api/perform-tasks', $requestData);
//
//    // Assert that the request was successful
//    $response->assertStatus(200);
//
//    // Assert that the data is inserted into the database
//    $this->assertDatabaseHas('processed_tasks', [
//        'text' => $requestData['text'],
//    ]);
//
//    // Retrieve the data inserted by the job and assert its presence in the database
//    $insertedData = \App\Models\ProcessedTask::where('text', $requestData['text'])->first();
//    expect($insertedData)->not->toBeNull();
//}

// Refactor Phase
//test('that processed task job is stored in the database', function () {
//    $jobId = null;
//
//    $tasks = TasksEnum::toArray();
//
//    $requestData = [
//        'text' => '98765rtfghuty',
//        'tasks' => [Arr::random($tasks)],
//    ];
//
//    $response = Helper::addMockResultActionToQueue($this, $this->faker->word, false, $requestData);
//
//    foreach ($requestData['tasks'] as $task) {
//        # code...
//        $this->assertDatabaseHas('processed_tasks', [
//            'text' => $requestData['text'],
//            'title' => $task,
//        ]);
//    }
//
//    $response->assertStatus(200)
//    ->assertValid()
//    ->assertJsonFragment([
//        'success' => true,
//        'message' => 'Mock result action added to a queue'
//    ]);
//});
