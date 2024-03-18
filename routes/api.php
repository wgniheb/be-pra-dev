<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdmStatusController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\IssueMatrixController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\ImpactStatusController;
use App\Http\Controllers\IssueCategoryController;
use App\Http\Controllers\PublishedStatusController;
use App\Http\Controllers\RoleHasPermissionController;
use App\Http\Controllers\CommunityProfilingController;
use App\Http\Controllers\StakeholderCategoryController;
use App\Http\Controllers\StakeholderProfilingController;

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
    Route::post('profile', [AuthController::class, 'profile']);
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('otp-verification', [AuthController::class, 'otpVerification']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    // Route::get('user-permission', [AuthController::class, 'permission']);
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

Route::group(['middleware' => 'api', 'prefix' => 'permission'], function(){
    Route::get('/', [PermissionController::class, 'index']);
    Route::post('/', [PermissionController::class, 'store']);
    Route::get('/{id}', [PermissionController::class, 'show']);
    Route::post('update/{id}', [PermissionController::class, 'update']);
    Route::delete('/{id}', [PermissionController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'role-has-permission'], function(){
    Route::get('/', [RoleHasPermissionController::class, 'index']);
    Route::post('/', [RoleHasPermissionController::class, 'store']);
    // Route::get('/{id}', [RoleHasPermissionController::class, 'show']);
    // Route::post('update/{id}', [RoleHasPermissionController::class, 'update']);
    // Route::delete('/{id}', [RoleHasPermissionController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'provinces'], function(){
    Route::get('/', [ProvinceController::class, 'index']);
    Route::post('/', [ProvinceController::class, 'store']);
    Route::get('/{id}', [ProvinceController::class, 'show']);
    Route::post('update/{id}', [ProvinceController::class, 'update']);
    Route::delete('/{id}', [ProvinceController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'cities'], function(){
    Route::get('/', [CityController::class, 'index']);
    Route::post('/', [CityController::class, 'store']);
    Route::get('/{id}', [CityController::class, 'show']);
    Route::post('update/{id}', [CityController::class, 'update']);
    Route::delete('/{id}', [CityController::class, 'destroy']);
    Route::get('province/{id}', [CityController::class, 'getCityByProvince']);
});

Route::group(['middleware' => 'api', 'prefix' => 'districts'], function(){
    Route::get('/', [DistrictController::class, 'index']);
    Route::post('/', [DistrictController::class, 'store']);
    Route::get('/{id}', [DistrictController::class, 'show']);
    Route::post('update/{id}', [DistrictController::class, 'update']);
    Route::delete('/{id}', [DistrictController::class, 'destroy']);
    Route::get('city/{id}', [DistrictController::class, 'getDistrictByCity']);
});

Route::group(['middleware' => 'api', 'prefix' => 'villages'], function(){
    Route::get('/', [VillageController::class, 'index']);
    Route::post('/', [VillageController::class, 'store']);
    Route::get('/{id}', [VillageController::class, 'show']);
    Route::post('update/{id}', [VillageController::class, 'update']);
    Route::delete('/{id}', [VillageController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'stakeholder-categories'], function(){
    Route::get('/', [StakeholderCategoryController::class, 'index']);
    Route::post('/', [StakeholderCategoryController::class, 'store']);
    Route::get('/{id}', [StakeholderCategoryController::class, 'show']);
    Route::post('update/{id}', [StakeholderCategoryController::class, 'update']);
    Route::delete('/{id}', [StakeholderCategoryController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'stakeholders'], function(){
    Route::get('/', [StakeholderController::class, 'index']);
    Route::post('/', [StakeholderController::class, 'store']);
    Route::get('/{id}', [StakeholderController::class, 'show']);
    Route::post('update/{id}', [StakeholderController::class, 'update']);
    Route::delete('/{id}', [StakeholderController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'community-profilings'], function(){
    Route::get('/', [CommunityProfilingController::class, 'index']);
    Route::post('/', [CommunityProfilingController::class, 'store']);
    Route::get('/{id}', [CommunityProfilingController::class, 'show']);
    // Route::get('/indeks-desa-membangun/{id}', [CommunityProfilingController::class, 'getIdm']);
    Route::get('/detail/{id}', [CommunityProfilingController::class, 'getDetailprofiling']);
    // Route::get('/{id}', [CommunityProfilingController::class, 'show']);
    Route::post('update/{id}', [CommunityProfilingController::class, 'update']);
    Route::delete('/{id}', [CommunityProfilingController::class, 'destroy']);
    Route::get('village/{id}', [CommunityProfilingController::class, 'indexByVillage']);
});

Route::group(['middleware' => 'api', 'prefix' => 'idm-status'], function(){
    Route::get('/', [IdmStatusController::class, 'index']);
    // Route::post('/', [IdmStatusController::class, 'store']);
    // Route::get('/{id}', [IdmStatusController::class, 'show']);
    // Route::post('update/{id}', [IdmStatusController::class, 'update']);
    // Route::delete('/{id}', [IdmStatusController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'stakeholder-profilings'], function(){
    Route::get('/', [StakeholderProfilingController::class, 'index']);
    Route::post('/', [StakeholderProfilingController::class, 'store']);
    Route::get('/{id}', [StakeholderProfilingController::class, 'show']);
    Route::get('profiling/{id}', [StakeholderProfilingController::class, 'getProfiling']);
    Route::post('update/{id}', [StakeholderProfilingController::class, 'update']);
    Route::delete('/{id}', [StakeholderProfilingController::class, 'destroy']);
});

Route::group(['middleware' => 'api', 'prefix' => 'published-status'], function(){
    Route::get('/', [PublishedStatusController::class, 'index']);
});

Route::group(['middleware' => 'api', 'prefix' => 'impact-status'], function(){
    Route::get('/', [ImpactStatusController::class, 'index']);
});

Route::group(['middleware' => 'api', 'prefix' => 'issue'], function(){
    Route::get('/', [IssueController::class, 'index']);
    Route::post('/', [IssueController::class, 'store']);
    Route::get('/{id}', [IssueController::class, 'show']);
    Route::post('update/{id}', [IssueController::class, 'update']);
    Route::delete('/{id}', [IssueController::class, 'destroy']);
});