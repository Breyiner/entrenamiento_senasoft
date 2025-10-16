<?php

namespace Database\Seeders\Permission;

use App\Models\Permission\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $permissions = [
      ['name' => 'statuses.index', 'description' => 'Ver listado de estados de usuario'],
      ['name' => 'statuses.show', 'description' => 'Ver detalle de un estado'],
      ['name' => 'statuses.store', 'description' => 'Crear un estado'],
      ['name' => 'statuses.update', 'description' => 'Actualizar un estado'],
      ['name' => 'statuses.destroy', 'description' => 'Eliminar un estado'],

      ['name' => 'users.index', 'description' => 'Ver listado de usuarios'],
      ['name' => 'users.show', 'description' => 'Ver detalle de cualquier usuario'],
      ['name' => 'users.show-own', 'description' => 'Ver mi propio usuario'],
      ['name' => 'users.store', 'description' => 'Crear un usuario'],
      ['name' => 'users.update-role', 'description' => 'Actualizar el rol de un usuario'],
      ['name' => 'users.update', 'description' => 'Actualizar cualquier usuario'],
      ['name' => 'users.update-own-password', 'description' => 'Actualizar mi propia contraseña'],
      ['name' => 'users.destroy', 'description' => 'Eliminar un usuario'],

      ['name' => 'roles.index', 'description' => 'Ver listado de roles'],
      ['name' => 'roles.show', 'description' => 'Ver detalle de un rol'],
      ['name' => 'roles.store', 'description' => 'Crear un rol'],
      ['name' => 'roles.update', 'description' => 'Actualizar un rol'],
      ['name' => 'roles.destroy', 'description' => 'Eliminar un rol'],

      ['name' => 'cities.index', 'description' => 'Ver listado de ciudades'],
      ['name' => 'cities.show', 'description' => 'Ver detalle de una ciudad'],
      ['name' => 'cities.store', 'description' => 'Crear una ciudad'],
      ['name' => 'cities.update', 'description' => 'Actualizar una ciudad'],
      ['name' => 'cities.destroy', 'description' => 'Eliminar una ciudad'],

      ['name' => 'genders.index', 'description' => 'Ver listado de géneros'],
      ['name' => 'genders.show', 'description' => 'Ver detalle de un género'],
      ['name' => 'genders.store', 'description' => 'Crear un género'],
      ['name' => 'genders.update', 'description' => 'Actualizar un género'],
      ['name' => 'genders.destroy', 'description' => 'Eliminar un género'],

      ['name' => 'arls.index', 'description' => 'Ver listado de ARL'],
      ['name' => 'arls.show', 'description' => 'Ver detalle de una ARL'],
      ['name' => 'arls.store', 'description' => 'Crear una ARL'],
      ['name' => 'arls.update', 'description' => 'Actualizar una ARL'],
      ['name' => 'arls.destroy', 'description' => 'Eliminar una ARL'],

      ['name' => 'clients.index', 'description' => 'Ver listado de clientes'],
      ['name' => 'clients.show', 'description' => 'Ver detalle de un cliente'],
      ['name' => 'clients.store', 'description' => 'Crear un cliente'],
      ['name' => 'clients.update', 'description' => 'Actualizar un cliente'],
      ['name' => 'clients.destroy', 'description' => 'Eliminar un cliente'],

      ['name' => 'profiles-users.index', 'description' => 'Ver listado de perfiles de usuario'],
      ['name' => 'profiles-users.show', 'description' => 'Ver detalle de un perfil de usuario'],
      ['name' => 'profiles-users.show-own', 'description' => 'Ver mi propio perfil de usuario'],
      ['name' => 'profiles-users.show-user', 'description' => 'Ver perfil de un usuario específico'],
      ['name' => 'profiles-users.update', 'description' => 'Actualizar perfil de usuario'],
      ['name' => 'profiles-users.update-own', 'description' => 'Actualizar mi propio perfil de usuario'],

      ['name' => 'profiles-clients.index', 'description' => 'Ver listado de perfiles de clientes'],
      ['name' => 'profiles-clients.show', 'description' => 'Ver detalle de un perfil de cliente'],
      ['name' => 'profiles-clients.show-user', 'description' => 'Ver perfil de un cliente específico'],
      ['name' => 'profiles-clients.update', 'description' => 'Actualizar perfil de cliente'],

      ['name' => 'activities.index', 'description' => 'Ver listado de actividades'],
      ['name' => 'activities.show', 'description' => 'Ver detalle de una actividad'],
      ['name' => 'activities.store', 'description' => 'Crear una actividad'],
      ['name' => 'activities.update', 'description' => 'Actualizar una actividad'],
      ['name' => 'activities.destroy', 'description' => 'Eliminar una actividad'],

      ['name' => 'order_statuses.index', 'description' => 'Ver listado de estados de órdenes'],
      ['name' => 'order_statuses.show', 'description' => 'Ver detalle de un estado de orden'],
      ['name' => 'order_statuses.store', 'description' => 'Crear un estado de orden'],
      ['name' => 'order_statuses.update', 'description' => 'Actualizar un estado de orden'],
      ['name' => 'order_statuses.destroy', 'description' => 'Eliminar un estado de orden'],

      ['name' => 'service_orders.index', 'description' => 'Ver listado de órdenes de servicio'],
      ['name' => 'service_orders.show', 'description' => 'Ver detalle de una orden de servicio'],
      ['name' => 'service_orders.store', 'description' => 'Crear una orden de servicio'],
      ['name' => 'service_orders.update', 'description' => 'Actualizar una orden de servicio'],
      ['name' => 'service_orders.destroy', 'description' => 'Eliminar una orden de servicio'],
      ['name' => 'service_orders.postpone', 'description' => 'Aplazar una orden de servicio'],
      ['name' => 'service_orders.accept', 'description' => 'Aceptar una orden de servicio'],
      ['name' => 'service_orders.reject', 'description' => 'Rechazar una orden de servicio'],
      ['name' => 'service_orders.reassign-professional', 'description' => 'Reasignar profesional en una orden de servicio'],

      ['name' => 'notes.index', 'description' => 'Ver listado de notas'],
      ['name' => 'notes.store', 'description' => 'Crear una nota'],

      ['name' => 'documents.index', 'description' => 'Ver listado de documentos'],
      ['name' => 'documents.store', 'description' => 'Crear un documento'],
      ['name' => 'documents.approve', 'description' => 'Aprobar un documento'],
      ['name' => 'documents.reject', 'description' => 'Rechazar un documento'],

      ['name' => 'document_statuses.index', 'description' => 'Ver listado de estados de documentos'],
      ['name' => 'document_statuses.show', 'description' => 'Ver detalle de un estado de documento'],
      ['name' => 'document_statuses.store', 'description' => 'Crear un estado de documento'],
      ['name' => 'document_statuses.update', 'description' => 'Actualizar un estado de documento'],
      ['name' => 'document_statuses.destroy', 'description' => 'Eliminar un estado de documento'],

      ['name' => 'notifications.index', 'description' => 'Ver listado de notificaciones'],
      ['name' => 'notifications.show-own', 'description' => 'Ver mis propias notificaciones'],
      ['name' => 'notifications.show', 'description' => 'Ver notificaciones de usuario'],
      ['name' => 'notifications.mark-as-read', 'description' => 'Marcar notificación como leída'],
    ];

    foreach ($permissions as $permission) {
      Permission::create([
        'name' => $permission['name'],
        'description' => $permission['description']
      ]);
    }
  }
}
