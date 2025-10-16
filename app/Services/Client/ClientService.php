<?php

namespace App\Services\Client;

use App\Models\Profile\ClientProfile\ClientProfile;
use App\Models\User\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ClientService
{

  public function getAllClients()
  {

    $clients = User::clients()->orderBy('status_id')->get();

    if (count($clients) == 0)
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay clientes registrados",
        "data" => $clients
      ];


    return [
      "error" => false,
      "code" => 200,
      "message" => "Clientes obtenidos con éxito",
      "data" => $clients
    ];
  }

  public function getAllInformation()
  {
    $clients = User::clients()->with(
      [
                    'clientProfile.city', 
                    'clientProfile.gender',
                    'clientProfile.arl',
                    'roles', 
                    'status'
                  ])->orderBy('status_id')->get();

    if ($clients->isEmpty()) {
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay clientes registrados",
        "data" => []
      ];
    }

    $data = $clients->map(function ($user) {
      return [
        'id' => $user->id,
        'company_name' => optional($user->clientProfile)->company_name,
        'document' => $user->document,
        'first_name' => optional($user->clientProfile)->first_name,
        'last_name' => optional($user->clientProfile)->last_name,
        'email' => optional($user->clientProfile)->email,
        'adress' => optional($user->clientProfile)->address,
        'phone_number' => optional($user->clientProfile)->phone_number,
        'city' => optional(optional($user->clientProfile)->city)->name,
        'gender' => optional(optional($user->clientProfile)->gender)->name,
        'role' => optional($user->roles()->first())->name,
        'status' => optional($user->status)->name,
      ];
    });

    return [
      "error" => false,
      "code" => 200,
      "message" => "Información obtenida con éxito",
      "data" => $data
    ];
  }

  public function getClient($id)
  {

    $client = User::where('id', $id)->first();

    if ($client) {
      $client = $client->clients()->first();
    } else {
      $client = null;
    }

    if (!$client)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este cliente no existe",
      ];

    $role = $client->roles()->first();

    return [
      "error" => false,
      "code" => 200,
      "message" => "Cliente obtenido con éxito",
      "data" => [
        'id' => $client->id,
        'email' => $client->email,
        'status_id' => $client->status_id,
        'role_id' => $role ? $role->id : null,
      ]
    ];
  }

  public function createClient(array $data)
  {

    try {
      DB::beginTransaction();

      $client = User::create([
        'document'    => $data['document'],
        'password' => Hash::make($data['document']),
      ]);

      $client->assignRole('Cliente');

      $data['user_id'] = $client->id;

      ClientProfile::create([
        'user_id' => $client->id,
        'company_name' => $data['company_name'],
        'arl_id' => $data['arl_id'],
        'address' => $data['address'],
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'phone_number' => $data['phone_number'],
        'email' => $data['email'],
        'city_id' => $data['city_id'],
        'gender_id' => $data['gender_id'],
      ]);

      DB::commit();

      return [
        'error' => false,
        'code' => 201,
        'message' => 'cliente creado con éxito',
      ];
    } catch (Exception $e) {

      DB::rollBack();
      return [
        "error" => true,
        "code" => 500,
        "message" => "Ocurrió un error al crear el cliente  {$e->getMessage()}",
      ];
    }
  }

  public function updateClient(array $data, $id)
  {

    try {
      DB::beginTransaction();

      $client = User::where('id', $id)->first();

      if ($client) {
        $client = $client->clients()->first();
      } else {
        $client = null;
      }

      if (!$client)
        return [
          "error" => true,
          "code" => 404,
          "message" => "Este cliente no existe",
        ];

      $client->update(Arr::only($data, ['status_id']));

      DB::commit();

      return [
        "error" => false,
        "code" => 200,
        "message" => "Cliente actualizado con éxito",
      ];
    } catch (Exception $e) {
      DB::rollBack();
      return [
        "error" => true,
        "code" => 500,
        "message" => "Ocurrió un error al actualizar el cliente",
      ];
    }
  }

  public function partialUpdateClient(array $entryData, $id)
  {

    try {
      DB::beginTransaction();

      $client = User::where('id', $id)->first();

      if ($client) {
        $client = $client->clients()->first();
      } else {
        $client = null;
      }

      if (!$client)
        return [
          "error" => true,
          "code" => 404,
          "message" => "Este cliente no existe",
        ];

      $client->update($entryData);

      DB::commit();

      return [
        "error" => false,
        "code" => 200,
        "message" => "Cliente actualizado con éxito",
      ];
    } catch (Exception $e) {
      DB::rollBack();
      return [
        "error" => true,
        "code" => 500,
        "message" => "Ocurrió un error al actualizar el cliente",
      ];
    }
  }

  public function softDeleteClient($id)
  {
    $client = User::where('id', $id)->first();

    if ($client) {
      $client = $client->clients()->first();
    } else {
      $client = null;
    }

    if (!$client)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este cliente no existe",
      ];

    $client->update(['status_id' => 2]);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Cliente desactivado con éxito",
    ];
  }

  public function deleteClient($id)
  {

    $client = User::where('id', $id)->first();

    if ($client) {
      $client = $client->clients()->first();
    } else {
      $client = null;
    }

    if (!$client)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este cliente no existe",
      ];

    $client->delete();

    return [
      "error" => false,
      "code" => 200,
      "message" => "Cliente eliminado con éxito",
    ];
  }
}
