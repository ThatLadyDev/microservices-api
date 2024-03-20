<?php

namespace App\DTOs;

readonly class ProcessedJobDTO
{
    public function __construct(
        public string $uuid,
        public string $type,
        public string $job_id,
        public array $metadata,
    ) {}

    public function toArray(): array {
        return [
            'uuid' => $this->uuid,
            'type' => $this->type,
            'job_id' => $this->job_id,
            'metadata' => $this->metadata,
        ];
    }
}
