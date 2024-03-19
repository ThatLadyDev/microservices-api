<?php

namespace App\Actions;

use App\Jobs\ProcessTasksJob;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Requests\API\PerformTasksRequest;

class PerformTasks
{
    use AsAction;

    /**
     * Handle the request to peform a task operation
     * @param array $inputData
     * @return void
     */
    public function handle(array $inputData = [])
    {
        dispatch(new ProcessTasksJob($inputData));
    }

    /**
     * To use this action class as a controller
     * @param \App\Http\Requests\API\PerformTasksRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function asController(PerformTasksRequest $request): JsonResponse
    {
        $this->handle($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Mock result action added to a queue',
        ]);
    }
}
