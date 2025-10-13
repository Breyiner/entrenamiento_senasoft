<?php

namespace App\Services\Profile\UserProfile;

use App\Models\Profile\Profile;
use Illuminate\Support\Arr;

class UserProfileService
{

  public static function getAll()
  {

    $profiles = Profile::nonClients()->get();

    if (count($profiles) == 0)
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay perfiles de usuarios registrados",
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

    $profile = Profile::where('id', $id)->first();

    if ($profile) {
      $profile = $profile->nonClients()->first();
    } else {
      $profile = null;
    }

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de usuario no existe",
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

    $profile = Profile::where('user_id', $user_id)->first();

    if ($profile) {
      $profile = $profile->nonClients()->first();
    } else {
      $profile = null;
    }

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de usuario no existe",
      ];

    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfil del usuario obtenido con éxito",
      "data" => $profile
    ];
  }

  public static function createProfile(array $data)
  {

    $profile = Profile::create([
      'user_id' => $data['user_id'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'city_id' => $data['city_id'],
      'gender_id' => $data['gender_id'],
    ]);

    if($profile->id) 
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

    $profile = Profile::where('user_id', $user_id)->nonClients()->first();

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de usuario no existe",
      ];

    $profile->update(Arr::only($data, 
    [
      'first_name', 
      'last_name',
      'phone_number',
      'email',
      'city_id', 
      'gender_id'
    ]));

    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfil actualizado con éxito",
    ];
  }

  public function partialUpdateProfile(array $entryData, $user_id)
  {

    $profile = Profile::where('user_id', $user_id)->nonClients()->first();

    if (!$profile)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este perfil de usuario no existe",
      ];

    $profile->update($entryData);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Perfil actualizado con éxito",
    ];
  }
}
