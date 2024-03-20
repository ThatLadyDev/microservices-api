<?php

namespace App\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProcessedJob;
use App\Models\ProcessedTask;
use Illuminate\Bus\Queueable;
use App\DTOs\ProcessedJobDTO;
use App\DTOs\ProcessedTaskDTO;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\Eloquent\EloquentRepository;

class ProcessTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var string $jobId */
    private string $jobId;

    /** @var array $taskData */
    private array $taskData;

    /** @var EloquentRepository $eloquentRepository */
    private EloquentRepository $eloquentRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(array $taskData = [])
    {
        $this->taskData = $taskData;
        $this->eloquentRepository = new EloquentRepository();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->jobId = $this->job->getJobId();

        foreach ($this->taskData['tasks'] as $task) {
            $taskUuid = Str::uuid();

            $this->eloquentRepository->create(
                new ProcessedJob(),
                $this->generateProcessedJobDTO($taskUuid)->toArray()
            );
            $this->eloquentRepository->create(
                new ProcessedTask(),
                $this->generateProcessedTaskDTO($taskUuid, $task)->toArray()
            );
        }
    }

    /**
     * @param string $taskUuid
     * @param string $title
     * @return ProcessedTaskDTO
     */
    private function generateProcessedTaskDTO(string $taskUuid, string $title): ProcessedTaskDTO
    {
        return new ProcessedTaskDTO(
            $taskUuid,
            $title,
            $this->taskData['text'],
            $this->fetchMockResultAction($title),
            true
        );
    }

    /**
     * @param string $taskUuid
     * @return ProcessedJobDTO
     */
    private function generateProcessedJobDTO(string $taskUuid): ProcessedJobDTO
    {
        return new ProcessedJobDTO(
            Str::uuid(),
            'task',
            $this->jobId,
            ['task-uuid' => $taskUuid]
        );
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
