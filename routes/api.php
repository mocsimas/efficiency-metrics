<?php

use Illuminate\Support\Facades\Route;
use \App\Interfaces\Http\Controllers\Tracker\TrackerController;
use \App\Interfaces\Http\Controllers\Workspace\WorkspaceController;
use \App\Interfaces\Http\Controllers\User\UserController;

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

Route::prefix("/{tracker}/workspaces")->group(function() {
    Route::get('/', [TrackerController::class, 'workspaces']);
    Route::post('/scrape', [TrackerController::class, 'scrapeWorkspaces']);
});

Route::prefix("/{tracker}/users")->group(function() {
    Route::get('/', [TrackerController::class, 'users']);
    Route::post('/scrape', [TrackerController::class, 'scrapeUsers']);
});
