<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/user')->group(function () {
    Route::post('/register', [UserController::class, 'register']); // generate new api token for bearer and get
    Route::post('/login', [UserController::class, 'login']); // generate new api token for bearer and get
});

Route::middleware('api.token.check')->group(function () { // api needs bearer token
    Route::prefix('/student')->group(function () {
        Route::post('/create', [StudentController::class, 'create']);
        Route::post('/search', [StudentController::class, 'search']);
        Route::post('/update', [StudentController::class, 'update']);
        Route::post('/delete', [StudentController::class, 'delete']);
    });

    Route::prefix('/teacher')->group(function () {
        Route::post('/create', [TeacherController::class, 'create']);
        Route::post('/search', [TeacherController::class, 'search']);
        Route::post('/update', [TeacherController::class, 'update']);
        Route::post('/delete', [TeacherController::class, 'delete']);
    });

    Route::prefix('/group')->group(function () {
        Route::post('/create', [GroupController::class, 'create']);
        Route::post('/search', [GroupController::class, 'search']);
        Route::post('/update', [GroupController::class, 'update']);
        Route::post('/delete', [GroupController::class, 'delete']);

        Route::prefix('/collective')->group(function () {
            Route::post('/add', [GroupController::class, 'collectiveAdd']);
            Route::get('/show/{groupId?}', [GroupController::class, 'collectiveShow']);
            Route::post('/remove', [GroupController::class, 'collectiveRemove']);
        });
    });
});

