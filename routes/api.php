<?php

use App\Actions\API\FetchMockResults;
use App\Actions\API\PerformTasks;
use Illuminate\Support\Facades\Route;

Route::post('perform-tasks', PerformTasks::class);
Route::get('mock-results/{jobId}', FetchMockResults::class);

