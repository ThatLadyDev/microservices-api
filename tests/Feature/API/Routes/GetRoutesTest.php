<?php

test('get route exists: mock-results/{jobId}', function () {
    $response = $this->getJson('/api/mock-results/jobId');
    $response->assertStatus(422);
});

test('is a get route: mock-results/{jobId}', function () {
    $response = $this->post('/api/mock-results/jobId');
    $response->assertStatus(405);
});
