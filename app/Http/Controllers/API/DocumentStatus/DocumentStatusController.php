<?php

namespace App\Http\Controllers\API\DocumentStatus;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStatus\StoreDocumentStatusRequest;
use App\Http\Requests\DocumentStatus\UpdateDocumentStatusRequest;
use App\Services\DocumentStatus\DocumentStatusService;

class DocumentStatusController extends Controller
{
  protected $service;

  public function __construct(DocumentStatusService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    $response = $this->service->getAll();

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function show(int $id)
  {
    $response = $this->service->getStatus($id);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function store(StoreDocumentStatusRequest $request)
  {
    $data = $request->validated();
    $response = $this->service->createStatus($data);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function update(UpdateDocumentStatusRequest $request, int $id)
  {
    $data = $request->validated();
    $response = $this->service->updateStatus($data, $id);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data']);
  }

  public function destroy(int $id)
  {
    $response = $this->service->deleteStatus($id);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
