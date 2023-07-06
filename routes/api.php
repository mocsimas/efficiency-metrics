<?php

use Illuminate\Support\Facades\Route;
use \App\Interfaces\Http\Controllers\Tracker\TrackerController;
use \App\Interfaces\Http\Controllers\Workspace\WorkspaceController;
use \App\Interfaces\Http\Controllers\User\UserController;
use \App\Interfaces\Http\Controllers\TimeEntry\TimeEntryController;
use \App\Interfaces\Http\Controllers\Metric\MetricController;

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

Route::prefix('/workspaces')->group(function() {
    Route::get('/', [WorkspaceController::class, 'index']);
});

Route::prefix('/users')->group(function() {
    Route::get('/', [UserController::class, 'index']);
});

Route::prefix('/time-entries')->group(function() {
    Route::get('/', [TimeEntryController::class, 'index']);
});

Route::prefix('/{tracker}/workspaces')->group(function() {
    Route::get('/', [TrackerController::class, 'workspaces']);
    Route::post('/scrape', [TrackerController::class, 'scrapeWorkspaces']);
});

Route::prefix('/{tracker}/users')->group(function() {
    Route::get('/', [TrackerController::class, 'users']);
    Route::post('/scrape', [TrackerController::class, 'scrapeUsers']);
});

Route::prefix('/{tracker}/time-entries')->group(function() {
    Route::get('/', [TrackerController::class, 'timeEntries']);
    Route::post('/scrape', [TrackerController::class, 'scrapeTimeEntries']);
});

Route::prefix('/metrics/workspaces')->group(function() {
    // TODO: add feature test
    Route::get('/{workspace}/duration', [MetricController::class, 'duration']);
});
