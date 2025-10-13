<?php

namespace App\Http\Controllers\API\Client;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\PartialUpdateClientRequest;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Services\Client\ClientService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
  use AuthorizesRequests;
  protected $clientService;

  public function __construct(ClientService $clientService)
  {
    $this->clientService = $clientService;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $response = $this->clientService->getAllClients();

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function indexAllInformation()
  {
    $response = $this->clientService->getAllInformation();

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $response = $this->clientService->getClient($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreClientRequest $request)
  {

    $data = $request->validated();

    $response = $this->clientService->createClient($data);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateClientRequest $request, string $id)
  {
    $data = $request->validated();

    $response = $this->clientService->updateClient($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function partialUpdate(PartialUpdateClientRequest $request, string $id)
  {

    $data = $request->validated();

    $response = $this->clientService->updateClient($data, $id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code'], $response['errors']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $response = $this->clientService->deleteClient($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function softDelete($id)
  {
    $response = $this->clientService->softDeleteClient($id);


    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
