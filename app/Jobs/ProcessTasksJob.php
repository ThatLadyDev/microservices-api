<?php

namespace App\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProcessedJob;
use App\Models\ProcessedTask;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobId;
    public $taskData;

    /**
     * Create a new job instance.
     */
    public function __construct(array $taskData = [])
    {
        $this->taskData = $taskData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->jobId = $this->job->getJobId();

        foreach ($this->taskData['tasks'] as $task) {
            # code...
            $taskUuid = Str::uuid();

            ProcessedJob::query()->create([
                'uuid' => Str::uuid(),
                'type' => 'task',
                'job_id' => $this->jobId,
                'metadata' => ['task-uuid' => $taskUuid]
            ]);

            ProcessedTask::query()->create([
                'uuid' => $taskUuid,
                'title' => $task,
                'text' => $this->taskData['text'],
                'action' => $this->fetchMockResultAction($task),
                'is_queued' => true,
            ]);
        }
    }

    /**
     * Summary of fetchMockResultAction
     * @param string $task
     * @return mixed
     */
    private function fetchMockResultAction(string $task)
    {
        $actions = [
            'call_reason' => ['Log reason', 'Document purpose', 'Note reason'],
            'call_actions' => ['Assign tasks', 'Note actions', 'Schedule follow-ups'],
            'satisfaction' => ['Send survey', 'Confirm satisfaction', 'Log feedback'],
            'call_segments' => ['Summarize points', 'Segment notes', 'Task segments'],
            'summary' => ['Document overview', 'Brief summary', 'Capture highlights']
        ];

        return Arr::random($actions[$task]);
    }
}
