<?php

test('post route exists: /api/perform-tasks', function () {
    $response = $this->postJson('/api/perform-tasks');
    $response->assertStatus(422);
});

test('is a post route: /api/perform-tasks', function () {
    $response = $this->get('/api/perform-tasks');
    $response->assertStatus(405);
});
