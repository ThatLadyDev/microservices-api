<?php

namespace Tests\Feature\API\Functionalities;

use App\Enums\TasksEnum;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProcessedJob;
use App\Models\ProcessedTask;
use Illuminate\Support\Facades\DB;
use App\Http\Responses\ApiResponse;
use App\Repositories\DTO\DTORepository;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(WithFaker::class, RefreshDatabase::class);

//Refactor Phase
test('that mock results can be retrieved', function (){
    $eloquentRepository = new EloquentRepository();
    $dtoRepository = new DTORepository();

    $tasks = TasksEnum::toArray();
    $requestData = [
        'tasks' => [Arr::random($tasks)],
    ];

    $taskUuid = Str::uuid();

    $eloquentRepository->create(
        new ProcessedJob(),
        $dtoRepository->generate('ProcessedJob', ['jobId' => '0987654356uiihgfds45', 'taskUuid' => $taskUuid]),
    );

    $eloquentRepository->create(
        new ProcessedTask(),
        $dtoRepository->generate(
            'ProcessedTask',
            ['taskUuid' => $taskUuid, 'title' => $requestData['tasks'][0], 'text' => 'test-test']
        )
    );

    $response = $this->getJson('/api/mock-results/'.'0987654356uiihgfds45');

    $response->assertStatus(200)
        ->assertValid()
        ->assertJsonFragment(
            Arr::except(ApiResponse::success('mock result retrieved')->toArray(), ['data'])
        );
});
