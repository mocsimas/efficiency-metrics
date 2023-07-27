<?php

use Illuminate\Support\Facades\Route;
use \App\Interfaces\Http\Controllers\Tracker\TrackerController;
use \App\Interfaces\Http\Controllers\Workspace\WorkspaceController;
use \App\Interfaces\Http\Controllers\User\UserController;
use \App\Interfaces\Http\Controllers\TimeEntry\TimeEntryController;
use \App\Interfaces\Http\Controllers\Metric\MetricController;
use \App\Interfaces\Http\Controllers\Import\ImportController;
use \App\Interfaces\Http\Controllers\Task\TaskController;
use \App\Interfaces\Http\Controllers\Project\ProjectController;
use \App\Interfaces\Http\Controllers\Estimate\EstimateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('import')->group(function() {
   Route::post('/', [ImportController::class, 'import']);
});

Route::prefix('/workspaces')->group(function() {
    Route::get('/', [WorkspaceController::class, 'index']);
});

Route::prefix('/users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
});

Route::prefix('/time-entries')->group(function() {
    Route::get('/', [TimeEntryController::class, 'index']);
});

Route::prefix('/projects')->group(function() {
    Route::get('/', [ProjectController::class, 'index']);

    Route::prefix('/{project}')->group(function() {
        Route::get('/tasks', [ProjectController::class, 'tasks']);
    });
});

Route::prefix('/estimates')->group(function() {
    Route::get('/', [EstimateController::class, 'index']);
    Route::post('/create', [EstimateController::class, 'create']);
    Route::post('/update', [EstimateController::class, 'update']);
});

Route::prefix('/tasks')->group(function() {
    Route::get('/', [TaskController::class, 'index']);
});

Route::prefix('/{tracker}/workspaces')->group(function() {
    Route::get('/', [TrackerController::class, 'workspaces']);
    Route::post('/import', [TrackerController::class, 'importWorkspaces']);
});

Route::prefix('/{tracker}/users')->group(function() {
    Route::get('/', [TrackerController::class, 'users']);
    Route::post('/import', [TrackerController::class, 'importUsers']);
});

Route::prefix('/{tracker}/time-entries')->group(function() {
    Route::get('/', [TrackerController::class, 'timeEntries']);
    Route::post('/import', [TrackerController::class, 'importTimeEntries']);
});

Route::prefix('/metrics/workspaces')->group(function() {
    Route::get('/{workspace}/duration', [MetricController::class, 'workspaceDuration']);
});
