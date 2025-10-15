<?php

namespace App\Services\Notification;

use App\Models\Notification\Notification;

class NotificationService
{

  public function getAll() {

    $notificaciones = Notification::orderBy("created_at","desc");

    if (count($notificaciones) == 0)
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay notificaciones registradas",
        "data" => $notificaciones
      ];


    return [
      "error" => false,
      "code" => 200,
      "message" => "Notificaciones obtenidas con éxito",
      "data" => $notificaciones
    ];

  }

  public function getByUser($userId) {

    $notificaciones = Notification::where("user_id", $userId)->orderBy("created_at","desc")->get();

    if (count($notificaciones) == 0)
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay notificaciones registradas",
        "data" => $notificaciones
      ];


    return [
      "error" => false,
      "code" => 200,
      "message" => "Notificaciones obtenidas con éxito",
      "data" => $notificaciones
    ];

  }

  public function create($userId, $accion, $parametros = [])
  {
    $mensajes = [
      'orden_asignada' => [
        'title' => 'Orden Asignada',
        'content' => 'Se te ha asignado la orden #' . ($parametros['numero_orden'] ?? ''),
      ],
      'orden_rechazada' => [
        'title' => 'Orden Rechazada',
        'content' => 'El profesional asignado rechazó la órden' . ($parametros['numero_orden'] ?? ''),
      ],
      'orden_aplazada' => [
        'title' => 'Orden Aplazada',
        'content' => 'El profesional' . ($parametros['profesional'] ?? '') . ', aplazó la órden #' . ($parametros['numero_orden'] ?? ''),
      ],
      'orden_reasignada' => [
        'title' => 'Orden Reasignada',
        'content' => 'La órden #' . ($parametros['numero_orden'] ?? '') . 'fue reasignada a otro profesional',
      ],
      'documento_rechazado' => [
        'title' => 'Documento Rechazado',
        'content' => 'El documento cargado en la órden' . ($parametros['numero_orden'] ?? '') . 'fué rechazado'
      ],
      'documento_aceptado' => [
        'title' => 'Documento Aceptado',
        'content' => 'El documento cargado en la órden' . ($parametros['numero_orden'] ?? '') . 'fué aceptado'
      ],
      'orden_lista' => [
        'title' => 'Órden Lista Para Facturar',
        'content' => 'La órden #' . ($parametros['numero_orden'] ?? '') . 'que se te asignó ya está lista para facturar',
      ],
    ];

    $mensaje = $mensajes[$accion] ?? [
      'title' => 'Notificación',
      'content' => 'Tienes una nueva notificación.',
    ];

    $notificacion = Notification::create([
      'user_id' => $userId,
      'title' => $mensaje['title'],
      'content' => $mensaje['content'],
      'read' => false,
    ]);

    return [
      'error' => false,
      'code' => 201,
      'message' => 'Notificación creada con éxito',
      'data' => []
    ];
  }

  public function markAsRead($notificacionId){

    $notificacion = Notification::find($notificacionId);

    if (!$notificacion)
      return [
        'error'=> true,
        'code' => 404,
        'message' => 'Esta notificación no existe'
      ];

    $notificacion::update(['read' => true]);

    return [
      'error' => false,
      'code' => 200,
      'message' => 'Notificación marcada como leída'
    ];

  }

}