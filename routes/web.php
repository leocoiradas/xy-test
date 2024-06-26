<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Login.index');
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function() {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('tasks', TaskController::class);
});
