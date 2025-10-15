<?php

namespace App\Services\Document;

use App\Models\Document\Document;
use App\Models\ServiceOrder\ServiceOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentService
{

  public function getAll($padreId, $modelo)
  {

    $modelos = [
      'service_order' => ServiceOrder::class,
    ];

    $padreModelo = $modelos[$modelo]::find($padreId);

    $documentos = $padreModelo->documents->map(function ($documento) {

      return [
        'id' => $documento->id,
        'original_name' => $documento->original_name,
        'mime_type' => $documento->mime_type,
        'size' => $documento->size,
        'url' => asset(path: 'storage/' . $documento->path),
        'status' => $documento->status->name,
      ];
    });

    return [
      "error" => false,
      "code" => 201,
      "message" => "Documentos obtenidos con éxito",
      "data" => $documentos,
    ];
  }

  public function createDocument($padreId, $modelo, $request)
  {

    DB::beginTransaction();
    $path = '';
    $file = '';
    try {

      $modelos = [
        'service_order' => ServiceOrder::class,
      ];

      $padre = $modelos[$modelo]::find($padreId);

      if ($request->hasFile('document')) {
        $file = $request->file('document');
        $path = Storage::disk('public')->putFile("$modelo/Documents", $file);
      }

      $document = Document::create([
        'original_name' => $file->getClientOriginalName(),
        'path' => $path,
        'mime_type' => $file->getMimeType(),
        'extension' => $file->getClientOriginalExtension(),
        'size' => $file->getSize(),
        'documentable_id' => $padreId,
        'documentable_type' => $padre::class,
      ]);

      DB::commit();

      return [
        "error" => false,
        "code" => 201,
        "message" => "Documento adjuntado con éxito",
        "data" => []
      ];
    } catch (\Exception $e) {
      DB::rollback();
      if (Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
      }

      return [
        "error" => true,
        "code" => 500,
        "message" => $e->getMessage(),
        "data" => []
      ];
    }
  }
}
