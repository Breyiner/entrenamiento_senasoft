<?php

namespace App\Http\Controllers\API\ServiceOrder;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceOrder\StoreServiceOrderRequest;
use App\Http\Requests\ServiceOrder\UpdateServiceOrderRequest;
use App\Http\Requests\ServiceOrder\PartialUpdateServiceOrderRequest;
use App\Http\Requests\ServiceOrder\PostponeOrderRequest;
use App\Http\Requests\ServiceOrder\ReassignProfessionalRequest;
use App\Services\ServiceOrder\ServiceOrderService;
use Illuminate\Http\Request;

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

  public function show(int $orderId)
  {
    $response = $this->serviceOrderService->getOrder($orderId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function showByStatus(int $statusId)
  {
    $response = $this->serviceOrderService->getByStatus($statusId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function showByProfessional(int $professionalId)
  {
    $response = $this->serviceOrderService->getByProfessional($professionalId);

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

  public function postpone(PostponeOrderRequest $request, $orderId)
  {

    $data = $request->validated();

    $response = $this->serviceOrderService->postponeOrder($orderId, $data);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);

  }

  public function accept(int $orderId)
  {
    $response = $this->serviceOrderService->acceptOrder($orderId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function reject(int $orderId)
  {
    $response = $this->serviceOrderService->rejectOrder($orderId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function reassignProfessional(ReassignProfessionalRequest $request, int $orderId)
  {
    $data = $request->validated();

    $response = $this->serviceOrderService->reassignProfessional($orderId, $data);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function update(UpdateServiceOrderRequest $request, int $orderId)
  {
    $data = $request->validated();

    $response = $this->serviceOrderService->updateOrder($data, $orderId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function partialUpdate(PartialUpdateServiceOrderRequest $request, int $orderId)
  {
    $data = $request->validated();

    $response = $this->serviceOrderService->partialUpdateOrder($data, $orderId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function destroy(int $orderId)
  {
    $response = $this->serviceOrderService->deleteOrder($orderId);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
