<?php

namespace App\Services\Activity;

use App\Models\Activity\Activity;
use Illuminate\Support\Arr;

class ActivityService
{
  public static function getAll()
  {
    $activities = Activity::all();

    if ($activities->isEmpty()) {
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay actividades registradas",
        "data" => $activities
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Actividades obtenidas con éxito",
      "data" => $activities
    ];
  }

  public function getActivity(int $id)
  {
    $activity = Activity::find($id);

    if (!$activity) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Esta actividad no existe",
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Actividad obtenida con éxito",
      "data" => $activity
    ];
  }

  public function createActivity(array $data)
  {
    $activity = Activity::create([
      'name' => $data['name'],
      'description' => $data['description'] ?? null,
    ]);

    return [
      "error" => false,
      "code" => 201,
      "message" => "Actividad creada con éxito",
      "data" => $activity
    ];
  }

  public function updateActivity(array $data, int $id)
  {
    $activity = Activity::find($id);

    if (!$activity) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Esta actividad no existe",
      ];
    }

    $activity->update(Arr::only($data, ['name', 'description']));

    return [
      "error" => false,
      "code" => 200,
      "message" => "Actividad actualizada con éxito",
      "data" => $activity
    ];
  }

  public function partialUpdateActivity(array $data, int $id)
  {
    $activity = Activity::find($id);

    if (!$activity) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Esta actividad no existe",
      ];
    }

    $activity->update($data);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Actividad actualizada con éxito",
      "data" => $activity
    ];
  }

  public function deleteActivity(int $id)
  {
    $activity = Activity::find($id);

    if (!$activity) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "La actividad no existe",
      ];
    }

    $activity->delete();

    return [
      "error" => false,
      "code" => 200,
      "message" => "Actividad eliminada con éxito",
    ];
  }
}
