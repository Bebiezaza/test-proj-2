<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;

Route::get('/index/world/something', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('index');
});

Route::post('/', [TodoController::class, 'create']);
Route::get('/edit/{id}', [TodoController::class, 'show']);
Route::post('/edit/{id}', [TodoController::class, 'update']);
Route::post('/checked/{id}', [TodoController::class, 'checked']);
Route::get('/delete/{id}', [TodoController::class, 'confirm']);
Route::post('/delete/{id}', [TodoController::class, 'delete']);
