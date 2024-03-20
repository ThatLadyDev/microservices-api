<?php

namespace App\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\ProcessedJob;
use App\Models\ProcessedTask;
use Illuminate\Bus\Queueable;
use App\DTOs\ProcessedJobDTO;
use App\DTOs\ProcessedTaskDTO;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use App\Repositories\DTO\DTORepository;
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

    /** @var DTORepository $dtoRepository */
    private DTORepository $dtoRepository;

    /**
     * Create a new job instance.
     */
    public function __construct(array $taskData = [])
    {
        $this->taskData = $taskData;
        $this->eloquentRepository = new EloquentRepository();
        $this->dtoRepository = new DTORepository();
    }

    // @codeCoverageIgnoreStart
    public function handle(): void
    {
        $this->jobId = $this->job->getJobId();

        foreach ($this->taskData['tasks'] as $task) {
            $taskUuid = Str::uuid();

            $this->eloquentRepository->create(
                new ProcessedJob(),
                $this->dtoRepository->generate('ProcessedJob', ['jobId' => $this->jobId, 'taskUuid' => $taskUuid]),
            );

            $this->eloquentRepository->create(
                new ProcessedTask(),
                $this->dtoRepository->generate(
                    'ProcessedTask',
                    ['taskUuid' => $taskUuid, 'title' => $task, 'text' => $this->taskData['text']]
                )
            );
        }
    }
    // @codeCoverageIgnoreEnd
}
