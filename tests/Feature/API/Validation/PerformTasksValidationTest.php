<?php

use Illuminate\Support\Str;

test('text field is required: /api/perform-tasks', function () {
    $response = $this->postJson('/api/perform-tasks', [
        'tasks' => ['call_reason'],
    ]);
    $response->assertInvalid(['text' => 'The text field is required']);
});

test('text field can\'t be more than predefined max length: /api/perform-tasks', function () {
    $response = $this->postJson('/api/perform-tasks', [
        'text' => Str::random(50),
        'tasks' => ['call_reason'],
    ]);
    $response->assertInvalid(['text' => 'The text field must not be greater than 30 characters.']);
});

test('tasks field is required: /api/perform-tasks', function () {
    $response = $this->postJson('/api/perform-tasks', [
        'text' => 'This is a simple text',
    ]);
    $response->assertInvalid(['tasks' => 'The tasks field must be present.']);
});

test('tasks field must be an array: /api/perform-tasks', function () {
    $response = $this->postJson('/api/perform-tasks', [
        'text' => 'This is a simple text',
        'tasks' => Str::random(5),
    ]);
    $response->assertInvalid(['tasks' => 'tasks field must be an array.']);
});

test('tasks field must not be an empty array: /api/perform-tasks', function () {
    $response = $this->postJson('/api/perform-tasks', [
        'text' => 'This is a simple text',
        'tasks' => [],
    ]);
    $response->assertInvalid(['tasks' => 'Tasks can\'t be empty']);
});

test('each item in the tasks field must be a valid task: /api/perform-tasks', function () {
    $response = $this->postJson('/api/perform-tasks', [
        'text' => Str::random(10),
        'tasks' => [Str::random(5)],
    ]);
    $response->assertInvalid(['tasks' => 'One or more tasks are invalid.']);
});
