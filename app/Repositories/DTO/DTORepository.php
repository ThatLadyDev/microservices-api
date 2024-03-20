<?php

namespace App\Repositories\DTO;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\DTOs\ProcessedJobDTO;
use App\DTOs\ProcessedTaskDTO;

class DTORepository
{
    /**
     * @param string $type
     * @param array $data
     * @return array
     */
    public function generate(string $type, array $data)
    {
        return ($type === 'ProcessedJob') ?
            $this->processedJobDTO($data['taskUuid'], $data['jobId'])->toArray() :
            $this->processedTaskDTO($data)->toArray();
    }

    /**
     * @param array $data
     * @return ProcessedTaskDTO
     */
    private function processedTaskDTO(array $data): ProcessedTaskDTO
    {
        return new ProcessedTaskDTO(
            $data['taskUuid'],
            $data['title'],
            $data['text'],
            $this->fetchMockResultAction($data['title']),
            true
        );
    }

    /**
     * @param string $taskUuid
     * @param string $jobId
     * @return ProcessedJobDTO
     */
    private function processedJobDTO(string $taskUuid, string $jobId): ProcessedJobDTO
    {
        return new ProcessedJobDTO(
            Str::uuid(),
            'task',
            $jobId,
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
