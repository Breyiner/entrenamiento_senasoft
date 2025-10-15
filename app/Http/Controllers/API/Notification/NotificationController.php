<?php

namespace App\Http\Controllers\API\Notification;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\Notification\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  protected $notificationService;

  public function __construct(NotificationService $notificationService)
  {
    $this->notificationService = $notificationService;
  }

  public function index() {

    $response = $this->notificationService->getAll();

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);

  }

  public function show($userId) {

    $response = $this->notificationService->getByUser($userId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);

  }

  public function showOwn()
  {

    $userId = Auth::user()->id;

    $response = $this->notificationService->getByUser($userId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);

  }
}
