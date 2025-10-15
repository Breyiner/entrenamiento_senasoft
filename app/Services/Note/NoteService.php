<?php

namespace App\Services\Note;

use App\Models\Document\Document;
use App\Models\Note\Note;
use App\Models\ServiceOrder\ServiceOrder;
use Illuminate\Support\Facades\Auth;

class NoteService
{

  public function getAll($padreId, $modelo)
  {
    $modelos = [
      'service_order' => ServiceOrder::class,
      'document' => Document::class,
    ];

    $notas = $modelos[$modelo]::find($padreId)->notes;

    if ($notas->isEmpty()) {
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay notas registrados",
        "data" => $notas
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Notas obtenidas con éxito",
      "data" => $notas
    ];
  }

  public function createNote($padreId, $modelo, $data)
  {

    $author = Auth::user()->profile->first_name;

    $modelos = [
      'service_order' => ServiceOrder::class,
      'document' => Document::class,
    ];

    $padre = $modelos[$modelo]::find($padreId);

    $nota = Note::create([
      'content' => $data['content'],
      'author' => $author,
      'notable_id' => $padre->id,
      'notable_type' => $padre::class,
    ]);

    if (!$nota) {
      return [
        "error" => true,
        "code" => 500,
        "message" => "No se pudo crear la nota",
        "data" => $nota
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "Nota creada correctamente",
      "data" => $nota
    ];
  }
}
