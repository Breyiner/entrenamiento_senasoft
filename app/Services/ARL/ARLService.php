<?php

namespace App\Services\ARL;

use App\Models\ARL\ARL;
use Illuminate\Support\Arr;

class ARLService
{
  public static function getAll()
  {
    $arls = ARL::all();

    if ($arls->isEmpty()) {
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay ARL registradas",
        "data" => $arls
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "ARL obtenidas con éxito",
      "data" => $arls
    ];
  }

  public function getARL($id)
  {
    $arl = ARL::find($id);

    if (!$arl) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Esta ARL no existe",
      ];
    }

    return [
      "error" => false,
      "code" => 200,
      "message" => "ARL obtenida con éxito",
      "data" => $arl
    ];
  }

  public function createARL(array $data)
  {
    $arl = ARL::create([
      'name' => $data['name'],
      'nit' => $data['nit'],
      'email' => $data['email'],
    ]);

    return [
      'error' => false,
      'code' => 201,
      'message' => 'ARL creada con éxito',
    ];
  }

  public function updateARL(array $data, $id)
  {
    $arl = ARL::find($id);

    if (!$arl) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Esta ARL no existe",
      ];
    }

    $arl->update(Arr::only($data, ['name', 'nit', 'email']));

    return [
      "error" => false,
      "code" => 200,
      "message" => "ARL actualizada con éxito",
    ];
  }

  public function partialUpdateARL(array $entryData, $id)
  {
    $arl = ARL::find($id);

    if (!$arl) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Esta ARL no existe",
      ];
    }

    $arl->update($entryData);

    return [
      "error" => false,
      "code" => 200,
      "message" => "ARL actualizada con éxito",
    ];
  }

  public function deleteARL($id)
  {
    $arl = ARL::find($id);

    if (!$arl) {
      return [
        "error" => true,
        "code" => 404,
        "message" => "Esta ARL no existe",
      ];
    }

    
    // if ($arl->users()->exists()) {
    //   return [
    //     "error" => true,
    //     "code" => 409,
    //     "message" => "No se puede eliminar la ARL porque tiene usuarios relacionados",
    //   ];
    // }

    $arl->delete();

    return [
      "error" => false,
      "code" => 200,
      "message" => "ARL eliminada con éxito",
    ];
  }
}
