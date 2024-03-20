<?php

test('job-id query parameter is required: /api/mock-results/{jobId}', function () {
    $response = $this->getJson('/api/mock-results');
    $response->assertStatus(404);
});

test('job-id must be valid: /api/mock-results/{jobId}', function () {
    $response = $this->getJson('/api/mock-results/8gf87vbw23456hjnoiu8-987j9');
    $response->assertInvalid(['job-id' => 'The selected job-id is invalid.']);
});
