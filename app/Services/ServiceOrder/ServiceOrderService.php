<?php

namespace App\Services\ServiceOrder;

use App\Models\ServiceOrder\ServiceOrder;
use App\Models\User\User;
use App\Services\Note\NoteService;
use App\Services\Notification\NotificationService;
use Illuminate\Support\Arr;

class ServiceOrderService
{

  protected $notificationService, $noteService;

  public function __construct(NotificationService $notificationService, NoteService $noteService)
  {
    $this->notificationService = $notificationService;
    $this->noteService = $noteService;
  }

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

  public function getByStatus($statusId)
  {
    $orders = ServiceOrder::where('status_id', $statusId)->get();

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

  public function getByProfessional($professionalId)
  {
    $professional = User::find($professionalId);

    if(!$professional) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "No existe este profesional",
        "data" => [],
      ];
    }

    $orders = ServiceOrder::where("professional_id", $professionalId)->get();

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
      'recepcionist_id' => $data['recepcionist_id'],
      'client_id' => $data['client_id'],
      'professional_id' => $data['professional_id'],
      'activity_id' => $data['activity_id'],
      'date' => $data['date'],
      'hours' => $data['hours'],
      'observations' => $data['observations'] ?? null,
    ]);

    return [
      "error" => false,
      "code" => 201,
      "message" => "Orden de servicio creada con éxito",
      "data" => $order,
    ];
  }

  public function postponeOrder($orderId, $data)
  {

    $order = ServiceOrder::find( $orderId);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    $order->update([
      'date' => $data['new_date'],
      'status_id' => 4,
    ]);

    $superAdminId = 1;

    $paramsNotification = [
      'profesional' => $order->professional->profile->full_name,
      'numero_orden' => $order->id,
    ];

    $this->notificationService->create($superAdminId, "orden_aplazada", $paramsNotification);

    $dataNote = [
      'content' => "Nota aplazada para la fecha " . $data['new_date']
    ];

    $this->noteService->createNote( $orderId, "service_order", $dataNote);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Orden aplazada exitosamente",
      "data" => $order,
    ];

  }

  public function acceptOrder(int $orderId)
  {
    $order = ServiceOrder::find($orderId);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    $order->update(['status_id' => 3]);

    $this->noteService->createNote($orderId, 'service_order', [
      'content' => 'Orden aceptada. Estado actualizado a Programada.'
    ]);

    $superAdminId = 1;
    $paramsNotification = [
      'profesional' => $order->professional->profile->full_name,
      'numero_orden' => $order->id,
    ];
    $this->notificationService->create($superAdminId, 'orden_aceptada', $paramsNotification);

    $this->notificationService->create($$order->recepcionist->id, 'orden_aceptada', $paramsNotification);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Orden aceptada exitosamente",
      "data" => $order,
    ];
  }

  public function rejectOrder(int $orderId)
  {
    $order = ServiceOrder::find($orderId);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    $order->update(['status_id' => 1]);

    $this->noteService->createNote($orderId, 'service_order', [
      'content' => 'Orden rechazada. Estado actualizado a Sin programar.'
    ]);

    $superAdminId = 1;
    $paramsNotification = [
      'profesional' => $order->professional->profile->full_name,
      'numero_orden' => $order->id,
    ];
    
    $this->notificationService->create($superAdminId, 'orden_rechazada', $paramsNotification);

    $this->notificationService->create($$order->recepcionist->id, 'orden_rechazada', $paramsNotification);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Orden rechazada exitosamente",
      "data" => $order,
    ];
  }

  public function reassignProfessional(int $orderId, array $data)
  {
    $order = ServiceOrder::find($orderId);

    if (!$order) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Orden de servicio no encontrada",
      ];
    }

    $newProfessionalId = $data['professional_id'];
    if (!$newProfessionalId) {
      return [
        "error" => true,
        "code" => 422,
        "message" => "No se especificó el profesional nuevo",
      ];
    }

    $oldProfessionalName = $order->professional->profile->full_name;

    $order->update(['professional_id' => $newProfessionalId]);

    $newProfessional = User::find($newProfessionalId);
    $newProfessionalName = $newProfessional->profile->full_name;

    $this->noteService->createNote($orderId, 'service_order', [
      'content' => "Reasignado profesional de {$oldProfessionalName} a {$newProfessionalName}."
    ]);

    $superAdminId = 1;
    $paramsNotification = [
      'profesional' => $newProfessionalName,
      'numero_orden' => $order->id,
    ];

    $this->notificationService->create($superAdminId, 'orden_reasignada', $paramsNotification);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Profesional reasignado correctamente",
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
      'recepcionist_id',
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
