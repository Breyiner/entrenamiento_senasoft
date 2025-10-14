<?php

namespace App\Services\ServiceOrder;

use App\Models\ServiceOrder\ServiceOrder;
use Illuminate\Support\Arr;

class ServiceOrderService
{
  public static function getAll()
  {
    $orders = ServiceOrder::with(['client', 'professional', 'activity', 'status'])->get();

    if ($orders->isEmpty()) {
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay órdenes de servicio registradas",
        "data" => $orders,
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Órdenes de servicio obtenidas con éxito",
      "data" => $orders,
    ];
  }

  public function getOrder(int $id)
  {
    $order = ServiceOrder::with(['client', 'professional', 'activity', 'status'])->find($id);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Orden de servicio obtenida con éxito",
      "data" => $order,
    ];
  }

  public function createOrder(array $data)
  {
    $order = ServiceOrder::create([
      'client_id' => $data['client_id'],
      'professional_id' => $data['professional_id'],
      'activity_id' => $data['activity_id'],
      'date' => $data['date'],
      'hours' => $data['hours'],
      'observations' => $data['observations'] ?? null,
      'status_id' => $data['status_id'],
    ]);

    return [
      "error" => false,
      "code" => 201,
      "message" => "Orden de servicio creada con éxito",
      "data" => $order,
    ];
  }

  public function updateOrder(array $data, int $id)
  {
    $order = ServiceOrder::find($id);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    $order->update(Arr::only($data, [
      'client_id',
      'professional_id',
      'activity_id',
      'date',
      'hours',
      'observations',
      'status_id',
    ]));

    return [
      "error" => false,
      "code" => 200,
      "message" => "Orden de servicio actualizada con éxito",
      "data" => $order,
    ];
  }

  public function partialUpdateOrder(array $data, int $id)
  {
    $order = ServiceOrder::find($id);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    $order->update($data);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Orden de servicio actualizada con éxito",
      "data" => $order,
    ];
  }

  public function deleteOrder(int $id)
  {
    $order = ServiceOrder::find($id);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    $order->delete();

    return [
      "error" => false,
      "code" => 200,
      "message" => "Orden de servicio eliminada con éxito",
    ];
  }
}
