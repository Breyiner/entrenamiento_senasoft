<?php

use App\Enums\TokenAbility;
use App\Http\Controllers\API\Activity\ActivityController;
use App\Http\Controllers\API\ARL\ARLController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\City\CityController;
use App\Http\Controllers\API\Gender\GenderController;
use App\Http\Controllers\API\Profile\ClientProfile\ClientProfileController;
use App\Http\Controllers\API\Profile\UserProfile\UserProfileController;
use App\Http\Controllers\API\Role\RoleController;
use App\Http\Controllers\API\Client\ClientController;
use App\Http\Controllers\API\Document\DocumentController;
use App\Http\Controllers\API\DocumentStatus\DocumentStatusController;
use App\Http\Controllers\API\Note\NoteController;
use App\Http\Controllers\API\Notification\NotificationController;
use App\Http\Controllers\API\OrderStatus\OrderStatusController;
use App\Http\Controllers\API\ServiceOrder\ServiceOrderController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\UserStatus\UserStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

  Route::post('/refresh-token', [AuthController::class, 'refreshToken'])
    ->middleware('ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value);

  Route::post('/logout', [AuthController::class, 'logOut']);

  Route::prefix('statuses')->group(function () {
    Route::get('/', [UserStatusController::class, 'index'])->middleware('permission:statuses.index');
    Route::get('/{status_id}', [UserStatusController::class, 'show'])->middleware('permission:statuses.show');
    Route::post('/', [UserStatusController::class, 'store'])->middleware('permission:statuses.store');
    Route::put('/{status_id}', [UserStatusController::class, 'update'])->middleware('permission:statuses.update');
    Route::patch('/{status_id}', [UserStatusController::class, 'partialUpdate'])->middleware('permission:statuses.update');
    Route::delete('/{status_id}', [UserStatusController::class, 'destroy'])->middleware('permission:statuses.destroy');
  });

  Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->middleware('permission:users.index');
    Route::get('/information', [UserController::class, 'indexAllInformation'])->middleware('permission:users.index');
    Route::get('/me', [UserController::class, 'showOwn'])->middleware('permission:users.show-own');
    Route::get('/{user_id}', [UserController::class, 'show'])->middleware('permission:users.show');
    Route::post('/', [UserController::class, 'store'])->middleware('permission:users.store');
    Route::put('/{user_id}', [UserController::class, 'update'])->middleware('permission:users.update');
    Route::patch('/{user_id}', [UserController::class, 'partialUpdate'])->middleware('permission:users.update');
    Route::patch('/me/password', [UserController::class, 'updateOwnPassword'])->middleware('permission:users.update-own-password');
    Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('permission:users.destroy');
    Route::delete('/{id}/soft', [UserController::class, 'softDelete'])->middleware('permission:users.destroy');
  });

  Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->middleware('permission:roles.index');
    Route::get('/{role_id}', [RoleController::class, 'show'])->middleware('permission:roles.show');
    Route::post('/', [RoleController::class, 'store'])->middleware('permission:roles.store');
    Route::put('/{role_id}', [RoleController::class, 'update'])->middleware('permission:roles.update');
    Route::patch('/{role_id}', [RoleController::class, 'partialUpdate'])->middleware('permission:roles.update');
    Route::delete('/{role_id}', [RoleController::class, 'destroy'])->middleware('permission:roles.destroy');
  });

  Route::prefix('cities')->group(function () {
    Route::get('/', [CityController::class, 'index'])->middleware('permission:cities.index');
    Route::get('/{city_id}', [CityController::class, 'show'])->middleware('permission:cities.show');
    Route::post('/', [CityController::class, 'store'])->middleware('permission:cities.store');
    Route::put('/{city_id}', [CityController::class, 'update'])->middleware('permission:cities.update');
    Route::patch('/{city_id}', [CityController::class, 'partialUpdate'])->middleware('permission:cities.update');
    Route::delete('/{city_id}', [CityController::class, 'destroy'])->middleware('permission:cities.destroy');
  });

  Route::prefix('genders')->group(function () {
    Route::get('/', [GenderController::class, 'index'])->middleware('permission:genders.index');
    Route::get('/{gender_id}', [GenderController::class, 'show'])->middleware('permission:genders.show');
    Route::post('/', [GenderController::class, 'store'])->middleware('permission:genders.store');
    Route::put('/{gender_id}', [GenderController::class, 'update'])->middleware('permission:genders.update');
    Route::patch('/{gender_id}', [GenderController::class, 'partialUpdate'])->middleware('permission:genders.update');
    Route::delete('/{gender_id}', [GenderController::class, 'destroy'])->middleware('permission:genders.destroy');
  });

  Route::prefix('arls')->group(function () {
    Route::get('/', [ARLController::class, 'index'])->middleware('permission:arls.index');
    Route::get('/{arl_id}', [ARLController::class, 'show'])->middleware('permission:arls.show');
    Route::post('/', [ARLController::class, 'store'])->middleware('permission:arls.store');
    Route::put('/{arl_id}', [ARLController::class, 'update'])->middleware('permission:arls.update');
    Route::patch('/{arl_id}', [ARLController::class, 'partialUpdate'])->middleware('permission:arls.update');
    Route::delete('/{arl_id}', [ARLController::class, 'destroy'])->middleware('permission:arls.destroy');
  });

  Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->middleware('permission:clients.index');
    Route::get('/information', [ClientController::class, 'indexAllInformation'])->middleware('permission:clients.index');
    Route::get('/{client_id}', [ClientController::class, 'show'])->middleware('permission:clients.show');
    Route::post('/', [ClientController::class, 'store'])->middleware('permission:clients.store');
    Route::put('/{client_id}', [ClientController::class, 'update'])->middleware('permission:clients.update');
    Route::patch('/{client_id}', [ClientController::class, 'partialUpdate'])->middleware('permission:clients.update');
    Route::delete('/{client_id}', [ClientController::class, 'destroy'])->middleware('permission:clients.destroy');
    Route::delete('/{client_id}/soft', [ClientController::class, 'softDelete'])->middleware('permission:clients.destroy');
  });

  Route::prefix('profiles/users')->group(function () {
    Route::get('/', [UserProfileController::class, 'index'])->middleware('permission:profiles-users.index');
    Route::get('/me', [UserProfileController::class, 'showOwn'])->middleware('permission:profiles-users.show-own');
    Route::get('/profile/{profile_id}', [UserProfileController::class, 'show'])->middleware('permission:profiles-users.show');
    Route::get('/user/{user_id}', [UserProfileController::class, 'showByUser'])->middleware('permission:profiles-users.show-user');
    Route::put('/me', [UserProfileController::class, 'updateOwn'])->middleware('permission:profiles-users.update-own');
    Route::put('/user/{user_id}', [UserProfileController::class, 'update'])->middleware('permission:profiles-users.update');
    Route::patch('/me', [UserProfileController::class, 'partialUpdateOwn'])->middleware('permission:profiles-users.update-own');
    Route::patch('/user/{user_id}', [UserProfileController::class, 'partialUpdate'])->middleware('permission:profiles-users.update');
  });

  Route::prefix('profiles/clients')->group(function () {
    Route::get('/', [ClientProfileController::class, 'index'])->middleware('permission:profiles-clients.index');
    Route::get('/profile/{profile_id}', [ClientProfileController::class, 'show'])->middleware('permission:profiles-clients.show');
    Route::get('/client/{user_id}', [ClientProfileController::class, 'showByUser'])->middleware('permission:profiles-clients.show-user');
    Route::put('/user/{user_id}', [ClientProfileController::class, 'update'])->middleware('permission:profiles-clients.update');
    Route::patch('/user/{user_id}', [ClientProfileController::class, 'partialUpdate'])->middleware('permission:profiles-clients.update');
  });

  Route::prefix('activities')->group(function () {
    Route::get('/', [ActivityController::class, 'index'])->middleware('permission:activities.index');
    Route::get('/{activity_id}', [ActivityController::class, 'show'])->middleware('permission:activities.show');
    Route::post('/', [ActivityController::class, 'store'])->middleware('permission:activities.store');
    Route::put('/{activity_id}', [ActivityController::class, 'update'])->middleware('permission:activities.update');
    Route::patch('/{activity_id}', [ActivityController::class, 'partialUpdate'])->middleware('permission:activities.update');
    Route::delete('/{activity_id}', [ActivityController::class, 'destroy'])->middleware('permission:activities.destroy');
  });

  Route::prefix('order_statuses')->group(function () {
    Route::get('/', [OrderStatusController::class, 'index'])->middleware('permission:order_statuses.index');
    Route::get('/{order_status_id}', [OrderStatusController::class, 'show'])->middleware('permission:order_statuses.show');
    Route::post('/', [OrderStatusController::class, 'store'])->middleware('permission:order_statuses.store');
    Route::put('/{order_status_id}', [OrderStatusController::class, 'update'])->middleware('permission:order_statuses.update');
    Route::patch('/{order_status_id}', [OrderStatusController::class, 'partialUpdate'])->middleware('permission:order_statuses.update');
    Route::delete('/{order_status_id}', [OrderStatusController::class, 'destroy'])->middleware('permission:order_statuses.destroy');
  });

  Route::prefix('service_orders')->group(function () {
    Route::get('/', [ServiceOrderController::class, 'index'])
      ->middleware('permission:service_orders.view_any');
    Route::get('/{service_order_id}', [ServiceOrderController::class, 'show'])
      ->middleware('permission:service_orders.view');
    Route::get('/status/{status_id}', [ServiceOrderController::class, 'showByStatus'])
      ->middleware('permission:service_orders.view_by_status');
    Route::get('/professional/{professional_id}', [ServiceOrderController::class, 'showByProfessional'])
      ->middleware('permission:service_orders.view_by_professional');
    Route::post('/', [ServiceOrderController::class, 'store'])
      ->middleware('permission:service_orders.create');
    Route::put('/{service_order_id}', [ServiceOrderController::class, 'update'])
      ->middleware('permission:service_orders.update');
    Route::patch('/{service_order_id}', [ServiceOrderController::class, 'partialUpdate'])
      ->middleware('permission:service_orders.update');
    Route::patch('/{service_order_id}/postpone', [ServiceOrderController::class, 'postpone'])
      ->middleware('permission:service_orders.postpone');
    Route::patch('/{service_order_id}/accept', [ServiceOrderController::class, 'accept'])
      ->middleware('permission:service_orders.accept');
    Route::patch('/{service_order_id}/reject', [ServiceOrderController::class, 'reject'])
      ->middleware('permission:service_orders.reject');
    Route::patch('/{service_order_id}/reassign-professional', [ServiceOrderController::class, 'reassignProfessional'])
      ->middleware('permission:service_orders.reassign_professional');
        
    Route::delete('/{service_order_id}', [ServiceOrderController::class, 'destroy'])
      ->middleware('permission:service_orders.delete');
  });


  Route::prefix('notes')->group(function () {
    Route::get('/service_orders/{service_order}', [NoteController::class, 'index'])->middleware('permission:notes.index');
    Route::post('/service_orders/{service_order}', [NoteController::class, 'store'])->middleware('permission:notes.store');
    Route::get('/documents/{document}', [NoteController::class, 'index'])->middleware('permission:notes.index');
    Route::post('/documents/{document}', [NoteController::class, 'store'])->middleware('permission:notes.store');
  });

  Route::prefix('service_orders/{service_order}/documents')->group(function () {
    Route::get('/', [DocumentController::class, 'index'])->middleware('permission:documents.index');
    Route::post('/', [DocumentController::class, 'store'])->middleware('permission:documents.store');
  });

  Route::prefix('documents')->group(function () {
    Route::patch('/{document}/approve', [DocumentController::class, 'approve'])->middleware('permission:documents.approve');
    Route::patch('/{document}/reject', [DocumentController::class, 'reject'])->middleware('permission:documents.reject');
  });

  Route::prefix('document_statuses')->group(function () {
    Route::get('/', [DocumentStatusController::class, 'index'])->middleware('permission:document_statuses.index');
    Route::get('/{document_status}', [DocumentStatusController::class, 'show'])->middleware('permission:document_statuses.show');
    Route::post('/', [DocumentStatusController::class, 'store'])->middleware('permission:document_statuses.store');
    Route::put('/{document_status}', [DocumentStatusController::class, 'update'])->middleware('permission:document_statuses.update');
    Route::delete('/{document_status}', [DocumentStatusController::class, 'destroy'])->middleware('permission:document_statuses.destroy');
  });

  Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->middleware('permission:notifications.index');
    Route::get('/me', [NotificationController::class, 'showOwn'])->middleware('permission:notifications.show-own');
    Route::get('/users/{userId}', [NotificationController::class, 'show'])->middleware('permission:notifications.show');
    Route::patch('/{notification_id}/read', [NotificationController::class, 'markAsRead'])->middleware('permission:notifications.mark-as-read');
  });
});
