<?php

namespace App\Http\Controllers\API\Activity;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\StoreActivityRequest;
use App\Http\Requests\Activity\UpdateActivityRequest;
use App\Http\Requests\Activity\PartialUpdateActivityRequest;
use App\Services\Activity\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
  protected $activityService;

  public function __construct(ActivityService $activityService)
  {
    $this->activityService = $activityService;
  }

  public function index()
  {
    $response = $this->activityService->getAll();

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function show(int $id)
  {
    $response = $this->activityService->getActivity($id);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function store(StoreActivityRequest $request)
  {
    $data = $request->validated();

    $response = $this->activityService->createActivity($data);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function update(UpdateActivityRequest $request, int $id)
  {
    $data = $request->validated();

    $response = $this->activityService->updateActivity($data, $id);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function partialUpdate(PartialUpdateActivityRequest $request, int $id)
  {
    $data = $request->validated();

    $response = $this->activityService->partialUpdateActivity($data, $id);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function destroy(int $id)
  {
    $response = $this->activityService->deleteActivity($id);

    if ($response['error']) {
      return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
