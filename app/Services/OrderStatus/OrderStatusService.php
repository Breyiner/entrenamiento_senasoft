<?php

namespace App\Services\OrderStatus;

use App\Models\OrderStatus\OrderStatus;
use Illuminate\Support\Arr;

class OrderStatusService
{
  public static function getAll()
  {
    $statuses = OrderStatus::all();

    if ($statuses->isEmpty()) {
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay estados registrados",
        "data" => $statuses
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Estados obtenidos con éxito",
      "data" => $statuses
    ];
  }

  public function getStatus($id)
  {
    $status = OrderStatus::find($id);

    if (!$status) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este estado no existe"
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Estado obtenido con éxito",
      "data" => $status
    ];
  }

  public function createStatus(array $data)
  {
    $status = OrderStatus::create([
      'name' => $data['name'],
    ]);

    return [
      "error" => false,
      "code" => 201,
      "message" => "Estado creado con éxito",
      "data" => $status
    ];
  }

  public function updateStatus(array $data, $id)
  {
    $status = OrderStatus::find($id);

    if (!$status) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este estado no existe"
      ];
    }

    $status->update(Arr::only($data, ['name']));

    return [
      "error" => false,
      "code" => 200,
      "message" => "Estado actualizado con éxito",
      "data" => $status
    ];
  }

  public function partialUpdateStatus(array $data, $id)
  {
    $status = OrderStatus::find($id);

    if (!$status) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este estado no existe"
      ];
    }

    $status->update($data);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Estado actualizado con éxito",
      "data" => $status
    ];
  }

  public function deleteStatus($id)
  {
    $status = OrderStatus::find($id);

    if (!$status) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "El estado no existe"
      ];
    }

    $status->delete();

    return [
      "error" => false,
      "code" => 200,
      "message" => "Estado eliminado con éxito"
    ];
  }
}
