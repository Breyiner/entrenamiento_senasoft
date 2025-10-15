<?php

namespace App\Http\Controllers\API\Document;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Services\Document\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
  protected $documentService;

  public function __construct(DocumentService $documentService)
  {
    $this->documentService = $documentService;
  }

  public function index(Request $request, $padreId)
  {

    $parametros = array_keys($request->route()->parameters());

    $response = $this->documentService->getAll($padreId, $parametros[0]);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }

  public function store(StoreDocumentRequest $request, $padreId)
  {

    $parametros = array_keys($request->route()->parameters());

    $response = $this->documentService->createDocument($padreId, $parametros[0], $request);

    if ($response['error'])
      return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
  }
}
