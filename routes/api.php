<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/tasks/{status?}', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'create']);
