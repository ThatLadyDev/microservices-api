<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobId;

    public $resultAction;
    public $taskData;

    /**
     * Create a new job instance.
     */
    public function __construct(string $resultAction, array $taskData = [])
    {
        $this->resultAction = $resultAction;
        $this->taskData = $taskData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger($this->resultAction);
        $this->jobId = $this->job->getJobId();
    }
}
