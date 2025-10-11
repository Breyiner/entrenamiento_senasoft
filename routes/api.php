<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(
  function () {

    Route::post('/refresh-token', [AuthController::class, 'refreshToken'])
      ->middleware('ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value);

    Route::post('/logout', [AuthController::class, 'logOut']);
  }
);
