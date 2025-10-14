<?php

namespace App\Http\Controllers\API\OrderStatus;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStatus\StoreOrderStatusRequest;
use App\Http\Requests\OrderStatus\UpdateOrderStatusRequest;
use App\Http\Requests\OrderStatus\PartialUpdateOrderStatusRequest;
use App\Services\OrderStatus\OrderStatusService;

class OrderStatusController extends Controller
{
  protected $orderStatusService;

  public function __construct(OrderStatusService $orderStatusService)
  {
    $this->orderStatusService = $orderStatusService;
  }

  public function index()
  {
    $response = $this->orderStatusService->getAll();

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function show($id)
  {
    $response = $this->orderStatusService->getStatus($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function store(StoreOrderStatusRequest $request)
  {
    $data = $request->validated();
    $response = $this->orderStatusService->createStatus($data);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function update(UpdateOrderStatusRequest $request, $id)
  {
    $data = $request->validated();
    $response = $this->orderStatusService->updateStatus($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function partialUpdate(PartialUpdateOrderStatusRequest $request, $id)
  {
    $data = $request->validated();
    $response = $this->orderStatusService->partialUpdateStatus($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function destroy($id)
  {
    $response = $this->orderStatusService->deleteStatus($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
