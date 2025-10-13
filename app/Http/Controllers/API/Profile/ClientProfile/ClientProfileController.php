<?php

namespace App\Http\Controllers\API\Profile\clientProfile;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartialUpdateClientProfileRequest as PartialUpdateProfileRequest;
use App\Http\Requests\UpdateClientProfileRequest as UpdateProfileRequest;
use App\Services\Profile\ClientProfile\ClientProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfileController extends Controller
{
  protected $profileService;

  public function __construct(ClientProfileService $profileService)
  {

    $this->profileService = $profileService;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $response = $this->profileService->getAll();

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $response = $this->profileService->getProfile($id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Display the specified resource.
   */
  public function showByUser(string $user_id)
  {
    $response = $this->profileService->getProfileByUser($user_id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateProfileRequest $request, string $user_id)
  {

    $data = $request->validated();

    $response = $this->profileService->updateProfile($data, $user_id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  /**
   * Update the specified resource in storage.
   */
  public function partialUpdate(PartialUpdateProfileRequest $request, string $user_id)
  {

    $data = $request->validated();

    $response = $this->profileService->partialUpdateProfile($data, $user_id);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
