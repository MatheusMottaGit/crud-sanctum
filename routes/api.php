<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/signIn', [AuthController::class, 'signIn']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/create', [NoteController::class, 'create']);
    Route::get('/read', [NoteController::class, 'read']);
    Route::put('/{id}/update', [NoteController::class, 'update']);
    Route::delete('/{id}/delete', [NoteController::class, 'delete']);
});
