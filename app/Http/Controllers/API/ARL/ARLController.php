<?php

namespace App\Http\Controllers\API\ARL;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ARL\PartialUpdateARLRequest;
use App\Http\Requests\ARL\StoreARLRequest;
use App\Http\Requests\ARL\UpdateARLRequest;
use App\Services\ARL\ARLService;
use Illuminate\Http\Request;

class ARLController extends Controller
{
  protected $arlService;

  public function __construct(ARLService $arlService)
  {
    $this->arlService = $arlService;
  }

  /**
   * Mostrar todas las ARL
   */
  public function index()
  {
    $response = $this->arlService->getAll();

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Mostrar ARL específica
   */
  public function show(string $id)
  {
    $response = $this->arlService->getARL($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Crear nueva ARL
   */
  public function store(StoreARLRequest $request)
  {
    $data = $request->validated();

    $response = $this->arlService->createARL($data);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Actualizar ARL completamente
   */
  public function update(UpdateARLRequest $request, string $id)
  {
    $data = $request->validated();

    $response = $this->arlService->updateARL($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Actualización parcial de ARL
   */
  public function partialUpdate(PartialUpdateARLRequest $request, string $id)
  {
    $data = $request->validated();

    $response = $this->arlService->partialUpdateARL($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Eliminar ARL
   */
  public function destroy(string $id)
  {
    $response = $this->arlService->deleteARL($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}