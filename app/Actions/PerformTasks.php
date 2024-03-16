<?php

namespace App\Actions;

use App\Http\Requests\API\PerformTasksRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class PerformTasks
{
    use AsAction;

    public function handle()
    {
        // ...
    }

    public function asController(PerformTasksRequest $request)
    {
        
    }
}
