<?php

namespace App\Http\Controllers\API\ServiceOrder;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceOrder\StoreServiceOrderRequest;
use App\Http\Requests\ServiceOrder\UpdateServiceOrderRequest;
use App\Http\Requests\ServiceOrder\PartialUpdateServiceOrderRequest;
use App\Services\ServiceOrder\ServiceOrderService;

class ServiceOrderController extends Controller
{
  protected $serviceOrderService;

  public function __construct(ServiceOrderService $serviceOrderService)
  {
    $this->serviceOrderService = $serviceOrderService;
  }

  public function index()
  {
    $response = $this->serviceOrderService->getAll();

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function show(int $id)
  {
    $response = $this->serviceOrderService->getOrder($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function store(StoreServiceOrderRequest $request)
  {
    $data = $request->validated();

    $response = $this->serviceOrderService->createOrder($data);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function update(UpdateServiceOrderRequest $request, int $id)
  {
    $data = $request->validated();

    $response = $this->serviceOrderService->updateOrder($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function partialUpdate(PartialUpdateServiceOrderRequest $request, int $id)
  {
    $data = $request->validated();

    $response = $this->serviceOrderService->partialUpdateOrder($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function destroy(int $id)
  {
    $response = $this->serviceOrderService->deleteOrder($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
