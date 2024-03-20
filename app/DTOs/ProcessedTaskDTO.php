<?php

namespace App\DTOs;

readonly class ProcessedTaskDTO
{
    public function __construct(
        public string $uuid,
        public string $title,
        public string $text,
        public string $action,
        public bool $is_queued,
    ) {}

    public function toArray()
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'text' => $this->text,
            'action' => $this->action,
            'is_queued' => $this->is_queued,
        ];
    }
}
