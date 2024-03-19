<?php

namespace App\Actions\API;

use App\Models\ProcessedJob;
use App\Http\Requests\API\FetchMockResultsRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class FetchMockResults
{
    use AsAction;

    public function handle(string $jobId)
    {
        return ProcessedJob::query()->where('job_id', $jobId)->first();
    }

    public function asController(string $jobId, FetchMockResultsRequest $request)
    {
        $data = $this->handle($jobId);
        return response()->json([
            'success' => true,
            'message' => 'mock result retrieved',
            'data' => $data
        ]);
    }

    private function fetchResults()
    {

    }
}
