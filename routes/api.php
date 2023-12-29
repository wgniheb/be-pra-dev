<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\IssueCategoryController;
use App\Http\Controllers\IssueMatrixController;

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

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
//    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('otp-verification', [AuthController::class, 'otpVerification']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

Route::group(['middleware' => 'api', 'prefix' => 'role'], function() {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('/{id}', [RoleController::class, 'show']);
    Route::post('update/{id}', [RoleController::class, 'update']);
    Route::delete('/{id}', [RoleController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'users'], function() {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
    Route::post('/', [UserController::class, 'store']);
    Route::post('update/{id}', [UserController::class, 'update']);
});

Route::group(['middleware' => 'api', 'prefix' => 'dashboard'], function(){
    Route::get('count-user', [DashboardController::class, 'countUser']);
    Route::get('count-role', [DashboardController::class, 'countRole']);
});

Route::group(['middleware' => 'api', 'prefix' => 'entity'], function(){
    Route::get('/', [EntityController::class, 'index']);
    Route::post('/', [EntityController::class, 'store']);
    Route::get('/{id}', [EntityController::class, 'show']);
    Route::post('update/{id}', [EntityController::class, 'update']);
    Route::delete('/{id}', [EntityController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'issue-category'], function(){
    Route::get('/', [IssueCategoryController::class, 'index']);
    Route::post('/', [IssueCategoryController::class, 'store']);
    Route::get('/{id}', [IssueCategoryController::class, 'show']);
    Route::post('update/{id}', [IssueCategoryController::class, 'update']);
    Route::delete('/{id}', [IssueCategoryController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'issue-matrix'], function(){
    Route::get('/', [IssueMatrixController::class, 'index']);
    Route::post('/', [IssueMatrixController::class, 'store']);
    Route::get('/{id}', [IssueMatrixController::class, 'show']);
    Route::post('update/{id}', [IssueMatrixController::class, 'update']);
    Route::delete('/{id}', [IssueMatrixController::class, 'destroy']);
});
