<?php

use App\Enums\TasksEnum;
use Illuminate\Support\Arr;
use function Pest\Stressless\stress;

//it('handles concurrent POST requests : {route-here}', function () {
//    $tasks = TasksEnum::toArray();
//    $requestData = [
//        'text' => 'test-test',
//        'tasks' => [Arr::random($tasks)],
//    ];
//
//    $result = stress(config('app.url') . '/api/perform-tasks')
//        ->post($requestData)
//        ->concurrently(requests: 2)->for(5)->seconds();
//
//    expect($result->requests->duration->med)
//        ->toBeLessThan(6);
//});

//it('handles concurrent POST requests', function () {
//
//});

//it('handles mixed GET and POST requests', function () {
//
//});

//test('example', function () {
//    $response = $this->get('/');
//
//    $response->assertStatus(200);
//});
