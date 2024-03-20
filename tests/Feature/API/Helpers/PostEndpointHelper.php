<?php

namespace Tests\Feature\API\Helpers;

use App\Enums\TasksEnum;
use Illuminate\Support\Arr;
use App\Jobs\ProcessTasksJob;
use Illuminate\Support\Facades\Queue;

class PostEndpointHelper
{
    public static function addMockResultActionToQueue($test, $word, bool $useFakeQueue = true, $requestData = [])
    {
        if ($useFakeQueue === true){
            Queue::fake(); // Fake the queue
        }

        if (count($requestData) === 0){
            $tasks = TasksEnum::toArray();
            $requestData = [
                'text' => 'test-test',
                'tasks' => [Arr::random($tasks)],
            ];
        }

        $response = $test->postJson('/api/perform-tasks', $requestData);

        if ($useFakeQueue === true){
            // Assert that the TestJob was dispatched to the queue
            Queue::assertPushed(ProcessTasksJob::class);
        }

        return $response;
    }
}
