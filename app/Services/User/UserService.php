<?php

namespace App\Services\User;

use App\Models\Profile\Profile;
use App\Models\User\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{

  public function getAllUsers()
  {

    $users = User::users()->get();

    if (count($users) == 0)
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay usuarios registrados",
        "data" => $users
      ];


    return [
      "error" => false,
      "code" => 200,
      "message" => "Usuarios obtenidos con éxito",
      "data" => $users
    ];
  }

  public function getAllInformation()
  {
    $users = User::users()->with(['profile.city', 'profile.gender', 'roles', 'status'])->get();

    if ($users->isEmpty()) {
      return [
        "error" => false,
        "code" => 200,
        "message" => "No hay usuarios registrados",
        "data" => []
      ];
    }

    $data = $users->map(function ($user) {
      return [
        'id' => $user->id,
        'document' => $user->document,
        'first_name' => optional($user->profile)->first_name,
        'last_name' => optional($user->profile)->last_name,
        'email' => optional($user->profile)->email,
        'phone_number' => optional($user->profile)->phone_number,
        'city' => optional(optional($user->profile)->city)->name,
        'gender' => optional(optional($user->profile)->gender)->name,
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

  public function getUser($id)
  {

    $user = User::where('id', $id)->first();

    if ($user) {
      $user = $user->users()->first();
    } else {
      $user = null;
    }

    if (!$user)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este usuario no existe",
      ];

    $role = $user->roles()->first();

    return [
      "error" => false,
      "code" => 200,
      "message" => "Usuario obtenido con éxito",
      "data" => [
        'id' => $user->id,
        'email' => $user->email,
        'status_id' => $user->status_id,
        'role_id' => $role ? $role->id : null,
      ]
    ];
  }

  public function createUser(array $data)
  {

    try {
      DB::beginTransaction();

      $user = User::create([
        'document'    => $data['document'],
        'password' => Hash::make($data['document']),
      ]);

      $role = Role::find($data['role_id']);
      $user->assignRole($role->name);

      $data['user_id'] = $user->id;

      Profile::create([
        'user_id' => $user->id,
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
        'message' => 'Usuario creado con éxito',
      ];

    } catch (Exception $e) {

      DB::rollBack();
      return [
        "error" => true,
        "code" => 500,
        "message" => "Ocurrió un error al crear el usuario  {$e->getMessage()}",
      ];
    }
  }

  public function updateUser(array $data, $id)
  {

    try {
      DB::beginTransaction();

      $user = User::where('id', $id)->first();

      if ($user) {
        $user = $user->users()->first();
      } else {
        $user = null;
      }

      if (!$user)
        return [
          "error" => true,
          "code" => 404,
          "message" => "Este usuario no existe",
        ];

      if (isset($data['role_id'])) {
        $authUser = Auth::user();
        if ($authUser && $authUser->can('users.update-role')) {
          $role = $user->roles()->first();
          if ($role) {
            $user->removeRole($role->name);
          }
          $newRole = Role::find($data['role_id']);
          if ($newRole) {
            $user->assignRole($newRole);
          }
        }
      }

      $user->update(Arr::only($data, ['status_id']));

      DB::commit();

      return [
        "error" => false,
        "code" => 200,
        "message" => "Usuario actualizado con éxito",
      ];
    } catch (Exception $e) {
      DB::rollBack();
      return [
        "error" => true,
        "code" => 500,
        "message" => "Ocurrió un error al actualizar el usuario",
      ];
    }
  }

  public function partialUpdateUser(array $entryData, $id)
  {

    try {
      DB::beginTransaction();

      $user = User::where('id', $id)->first();

      if ($user) {
        $user = $user->users()->first();
      } else {
        $user = null;
      }

      if (!$user)
        return [
          "error" => true,
          "code" => 404,
          "message" => "Este usuario no existe",
        ];

      if (isset($entryData['role_id'])) {
        $authUser = Auth::user();
        if ($authUser && $authUser->can('users.update-role')) {
          $role = $user->roles()->first();
          if ($role) {
            $user->removeRole($role->name);
          }
          $newRole = Role::find($entryData['role_id']);
          if ($newRole) {
            $user->assignRole($newRole);
          }
        }
      }

      $user->update($entryData);

      DB::commit();

      return [
        "error" => false,
        "code" => 200,
        "message" => "Usuario actualizado con éxito",
      ];
    } catch (Exception $e) {
      DB::rollBack();
      return [
        "error" => true,
        "code" => 500,
        "message" => "Ocurrió un error al actualizar el usuario",
      ];
    }
  }

  public function updatePassword(array $data, $id)
  {

    $user = User::where('id', $id)->first();

    if ($user) {
      $user = $user->users()->first();
    } else {
      $user = null;
    }

    if (!$user)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este usuario no existe",
      ];

    if ($data['current_password'])
      if (!Hash::check($data['current_password'], $user->password))
        return [
          "error" => true,
          "code" => 401,
          "message" => "Contraseña incorrecta"
        ];


    $user->update([
      "password" => Hash::make($data['password'])
    ]);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Contraseña actualizada con éxito",
    ];
  }

  public function softDeleteUser($id)
  {
    $user = User::where('id', $id)->first();

    if ($user) {
      $user = $user->users()->first();
    } else {
      $user = null;
    }

    if (!$user)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este usuario no existe",
      ];

    $user->update(['status_id' => 2]);

    return [
      "error" => false,
      "code" => 200,
      "message" => "Usuario desactivado con éxito",
    ];
  }

  public function deleteUser($id)
  {

    $user = User::where('id', $id)->first();

    if ($user) {
      $user = $user->users()->first();
    } else {
      $user = null;
    }

    if (!$user)
      return [
        "error" => true,
        "code" => 404,
        "message" => "Este usuario no existe",
      ];

    $user->delete();

    return [
      "error" => false,
      "code" => 200,
      "message" => "Usuario eliminado con éxito",
    ];
  }
}
