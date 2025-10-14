<?php

namespace App\Http\Controllers\API\Note;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Note\StoreNoteRequest;
use App\Services\Note\NoteService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    protected $noteService;

    public function __construct(NoteService $noteService){
        $this->noteService = $noteService;
    }

    public function index(Request $request, $padreId)
    {
        
        $parametros = array_keys($request->route()->parameters());

        $response = $this->noteService->getAll($padreId, $parametros[0]);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);

    }

    public function store(StoreNoteRequest $request, $padreId)
    {
        $data = $request->validated();
        
        $parametros = array_keys($request->route()->parameters());

        $response = $this->noteService->createNote($padreId, $parametros[0], $data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);

    }
}
