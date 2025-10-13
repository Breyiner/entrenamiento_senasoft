<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\ARL\ARLController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\City\CityController;
use App\Http\Controllers\API\Gender\GenderController;
use App\Http\Controllers\API\Profile\ClientProfile\ClientProfileController;
use App\Http\Controllers\API\Profile\UserProfile\UserProfileController;
use App\Http\Controllers\API\Role\RoleController;
use App\Http\Controllers\API\Client\ClientController;
use App\Http\Controllers\API\User\UserController;
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


    //* Routes User
    Route::get('/users', [UserController::class, 'index']);
      // ->middleware('permission:users.index');
  
    Route::get('/users/information', [UserController::class, 'indexAllInformation']);
    //   ->middleware('permission:users.index');

    Route::get('/users/me', [UserController::class, 'showOwn']);
      // ->middleware('permission:users.show-own');

    Route::get('/users/{user_id}', [UserController::class, 'show']);
      // ->middleware('permission:users.show');

    Route::post('/users', [UserController::class, 'store']);
      // ->middleware('permission:users.store');

    Route::put('/users/{user_id}', [UserController::class, 'update']);
      // ->middleware('permission:users.update');

    Route::patch('/users/{user_id}', [UserController::class, 'partialUpdate']);
      // ->middleware('permission:users.update');

    Route::patch('/users/me/password', [UserController::class, 'updateOwnPassword']);
      // ->middleware('permission:users.update-own-password');

    Route::delete('/users/{id}', [UserController::class, 'destroy']);
      // ->middleware('permission:users.destroy');

    Route::delete('/users/{id}/soft', [UserController::class, 'softDelete']);
      // ->middleware('permission:users.destroy');


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


    //* Routes arls
    
    Route::get('/arls', [ARLController::class, 'index']);

    Route::get('/arls/{arl_id}', [ARLController::class, 'show']);
    // ->middleware('permission:arls.show');

    Route::post('/arls', [ARLController::class, 'store']);
    // ->middleware('permission:arls.store');

    Route::put('/arls/{arl_id}', [ARLController::class, 'update']);
    // ->middleware('permission:arls.update');

    Route::patch('/arls/{arl_id}', [ARLController::class, 'partialUpdate']);
    // ->middleware('permission:arls.update');

    Route::delete('/arls/{arl_id}', [ARLController::class, 'destroy']);
    // ->middleware('permission:arls.destroy');


    //* Rutas Cliente
    Route::get('/clients', [ClientController::class, 'index']);
    // ->middleware('permission:clients.index');

    Route::get('/clients/information', [ClientController::class, 'indexAllInformation']);
    //   ->middleware('permission:clients.index');

    Route::get('/clients/{client_id}', [ClientController::class, 'show']);
    // ->middleware('permission:clients.show');

    Route::post('/clients', [ClientController::class, 'store']);
    // ->middleware('permission:clients.store');

    Route::put('/clients/{client_id}', [ClientController::class, 'update']);
    // ->middleware('permission:clients.update');

    Route::patch('/clients/{client_id}', [ClientController::class, 'partialUpdate']);
    // ->middleware('permission:clients.update');

    Route::delete('/clients/{client_id}', [ClientController::class, 'destroy']);
    // ->middleware('permission:clients.destroy');

    Route::delete('/clients/{client_id}/soft', [ClientController::class, 'softDelete']);
    // ->middleware('permission:clients.destroy');



    //* Routes profiles usuarios
    Route::get('/profiles/users', [UserProfileController::class, 'index']);
      // ->middleware('permission:profiles-users.index');

    Route::get('/profiles/me', [UserProfileController::class, 'showOwn']);
      // ->middleware('permission:profiles-users.show-own');

    Route::get('/profiles/users/profile/{profile_id}', [UserProfileController::class, 'show']);
      // ->middleware('permission:profiles-users.show');

    Route::get('/profiles/users/user/{user_id}', [UserProfileController::class, 'showByUser']);
      // ->middleware('permission:profiles-users.show-user');

    Route::put('/profiles/me', [UserProfileController::class, 'updateOwn']);
      // ->middleware('permission:profiles-users.update-own');

    Route::put('/profiles/user/{user_id}', [UserProfileController::class, 'update']);
      // ->middleware('permission:profiles-users.update');

    Route::patch('/profiles/me', [UserProfileController::class, 'partialUpdateOwn']);
      // ->middleware('permission:profiles-users.update-own');

    Route::patch('/profiles/user/{user_id}', [UserProfileController::class, 'partialUpdate']);
    // ->middleware('permission:profiles-users.update');


    //* Routes profiles clientes
    Route::get('/profiles/clients', [ClientProfileController::class, 'index']);
    // ->middleware('permission:profiles-clients.index');

    Route::get('/profiles/clients/profile/{profile_id}', [ClientProfileController::class, 'show']);
    // ->middleware('permission:profiles-clients.show');

    Route::get('/profiles/clients/client/{user_id}', [ClientProfileController::class, 'showByUser']);
    // ->middleware('permission:profiles-clients.show-user');

    Route::put('/profiles/user/{user_id}', [ClientProfileController::class, 'update']);
    // ->middleware('permission:profiles-clients.update');

    Route::patch('/profiles/user/{user_id}', [ClientProfileController::class, 'partialUpdate']);
    // ->middleware('permission:profiles-clients.update');
  }
);
