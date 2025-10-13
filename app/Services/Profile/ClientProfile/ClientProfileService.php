<?php

namespace App\Services\Profile\ClientProfile;

use App\Models\Profile\ClientProfile\ClientProfile;
use Illuminate\Support\Arr;

class ClientProfileService
{

  public static function getAll()
  {

    $profiles = ClientProfile::onlyClients()->get();

    if (count($profiles) == 0)
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay perfiles de clientes registrados",
        "data" => $profiles
      ];


    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfiles obtenidos con éxito",
      "data" => $profiles
    ];
  }

  public function getProfile($id)
  {

    $profile = ClientProfile::where('id', $id)->first();

    if ($profile) {
      $profile = $profile->onlyClients()->first();
    } else {
      $profile = null;
    }

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de cliente no existe",
      ];

    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfil obtenido con éxito",
      "data" => $profile
    ];
  }

  public function getProfileByUser($user_id)
  {

    $profile = ClientProfile::where('user_id', $user_id)->first();

    if ($profile) {
      $profile = $profile->onlyClients()->first();
    } else {
      $profile = null;
    }

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de cliente no existe",
      ];

    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfil del cliente obtenido con éxito",
      "data" => $profile
    ];
  }

  public static function createProfile(array $data)
  {

    $profile = ClientProfile::create([
      'user_id' => $data['user_id'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'city_id' => $data['city_id'],
      'gender_id' => $data['gender_id'],
    ]);

    if ($profile->id)
      return [
        'error' => false,
        'code' => 201,
        'message' => 'Perfil creado con éxito',
      ];

    return [
      'error' => true,
      'code' => 500,
      'message' => 'Error al intentar crear el pefríl',
    ];
  }

  public function updateProfile(array $data, $user_id)
  {

    $profile = ClientProfile::where('user_id', $user_id)->first();

    if ($profile) {
      $profile = $profile->onlyClients()->first();
    } else {
      $profile = null;
    }

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de cliente no existe",
      ];

    $profile->update(Arr::only(
      $data,
      [
        'company_name',
        'arl_id',
        'address',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'city_id',
        'gender_id'
      ]
    ));

    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfil actualizado con éxito",
    ];
  }

  public function partialUpdateProfile(array $entryData, $user_id)
  {

    $profile = ClientProfile::where('user_id', $user_id)->first();

    if ($profile) {
      $profile = $profile->onlyClients()->first();
    } else {
      $profile = null;
    }

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de cliente no existe",
      ];

    $profile->update($entryData);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfil actualizado con éxito",
    ];
  }
}
