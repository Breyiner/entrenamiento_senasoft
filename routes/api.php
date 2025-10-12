<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\City\CityController;
use App\Http\Controllers\API\Gender\GenderController;
use App\Http\Controllers\API\Role\RoleController;
use App\Http\Controllers\API\UserStatus\UserStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(
  function () {

    Route::post('/refresh-token', [AuthController::class, 'refreshToken'])
      ->middleware('ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value);

    Route::post('/logout', [AuthController::class, 'logOut']);


    // * Routes user status
    Route::get('/statuses', [UserStatusController::class, 'index']);
    // ->middleware('permission:statuses.index');

    Route::get('/statuses/{status_id}', [UserStatusController::class, 'show']);
    // ->middleware('permission:statuses.show');

    Route::post('/statuses', [UserStatusController::class, 'store']);
    // ->middleware('permission:statuses.store');

    Route::put('/statuses/{status_id}', [UserStatusController::class, 'update']);
    // ->middleware('permission:statuses.update');

    Route::patch('/statuses/{status_id}', [UserStatusController::class, 'partialUpdate']);
    // ->middleware('permission:statuses.update');

    Route::delete('/statuses/{status_id}', [UserStatusController::class, 'destroy']);
    // ->middleware('permission:statuses.destroy');

    //* Routes roles
    Route::get('/roles', [RoleController::class, 'index']);
    // ->middleware('permission:roles.index');

    Route::get('/roles/{role_id}', [RoleController::class, 'show']);
    // ->middleware('permission:roles.show');

    Route::post('/roles', [RoleController::class, 'store']);
    // ->middleware('permission:roles.store');

    Route::put('/roles/{role_id}', [RoleController::class, 'update']);
    // ->middleware('permission:roles.update');

    Route::patch('/roles/{role_id}', [RoleController::class, 'partialUpdate']);
    // ->middleware('permission:roles.update');

    Route::delete('/roles/{role_id}', [RoleController::class, 'destroy']);
    // ->middleware('permission:roles.destroy');


    //* Routes city

    Route::get('/cities', [CityController::class, 'index']);

    Route::get('/cities/{city_id}', [CityController::class, 'show']);
      // ->middleware('permission:cities.show');

    Route::post('/cities', [CityController::class, 'store']);
      // ->middleware('permission:cities.store');

    Route::put('/cities/{city_id}', [CityController::class, 'update']);
      // ->middleware('permission:cities.update');

    Route::patch('/cities/{city_id}', [CityController::class, 'partialUpdate']);
      // ->middleware('permission:cities.update');

    Route::delete('/cities/{city_id}', [CityController::class, 'destroy']);
    // ->middleware('permission:cities.destroy');


    //* Routes gender

    Route::get('/genders', [GenderController::class, 'index']);

    Route::get('/genders/{gender_id}', [GenderController::class, 'show']);
      // ->middleware('permission:genders.show');

    Route::post('/genders', [GenderController::class, 'store']);
      // ->middleware('permission:genders.store');

    Route::put('/genders/{gender_id}', [GenderController::class, 'update']);
      // ->middleware('permission:genders.update');

    Route::patch('/genders/{gender_id}', [GenderController::class, 'partialUpdate']);
      // ->middleware('permission:genders.update');

    Route::delete('/genders/{gender_id}', [GenderController::class, 'destroy']);
      // ->middleware('permission:genders.destroy');
  }
);
