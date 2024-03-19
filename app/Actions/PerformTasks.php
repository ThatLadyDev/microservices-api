<?php

namespace App\Actions;

use App\Jobs\ProcessTasksJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Queue;
use Lorisleiva\Actions\Concerns\AsAction;
use App\Http\Requests\API\PerformTasksRequest;

class PerformTasks
{
    use AsAction;

    public function handle(string $mockResultAction)
    {
        dispatch(new ProcessTasksJob($mockResultAction));

        // Assert that the job was pushed onto the queue
        Queue::assertPushed(ProcessTasksJob::class);
    }

    /**
     * To use this action class as a controller
     * @param \App\Http\Requests\API\PerformTasksRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function asController(PerformTasksRequest $request): JsonResponse
    {
        $this->handle($this->fetchMockResultAction());
        return response()->json([
            'success' => true,
            'message' => 'Mock result action added to a queue',
        ]);
    }

    private function fetchMockResultAction()
    {
        $actions = [
            'call_reason' => ['Log reason', 'Document purpose', 'Note reason'],
            'call_actions' => ['Assign tasks', 'Note actions', 'Schedule follow-ups'],
            'satisfaction' => ['Send survey', 'Confirm satisfaction', 'Log feedback'],
            'call_segments' => ['Summarize points', 'Segment notes', 'Task segments'],
            'summary' => ['Document overview', 'Brief summary', 'Capture highlights']
        ];

        $selectedAction = array_rand($actions);
        $selectedResultActionKey = array_rand($actions[$selectedAction]);
        return $actions[$selectedAction][$selectedResultActionKey];
    }
}
