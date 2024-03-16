<?php

use App\Actions\PerformTasks;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('perform-tasks', PerformTasks::class);
