<?php

namespace Database\Seeders\RolePermission;

use App\Models\Permission\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::findByName('Super Administrador');
        $profesional = Role::findByName('Profesional');
        $recepcionista = Role::findByName('Recepcionista');
        $cliente = Role::findByName('Cliente');

        $superAdmin->syncPermissions(Permission::all());

        $profesional->syncPermissions([
            'users.show-own',
            'users.update-own-password',

            'cities.index',
            'cities.show',

            'genders.index',
            'genders.show',

            'arls.index',
            'arls.show',

            'clients.index',
            'clients.show',
            'cities.update',

            'profiles-users.show-own',
            'profiles-users.update-own',
            'profiles-clients.show-user',

            'activities.index',
            'activities.show',

            'order_statuses.index',
            'order_statuses.show',

            'service_orders.view',
            'service_orders.view_by_professional',
            'service_orders.postpone',
            'service_orders.accept',
            'service_orders.reject',

            'notes.index',
            'notes.store',

            'documents.index',
            'documents.store',
            'documents.approve',
            'documents.reject',

            'notifications.show-own',
            'notifications.mark-as-read',
        ]);

        $recepcionista->syncPermissions([
            'cities.index',
            'cities.show',

            'genders.index',
            'genders.show',

            'arls.index',
            'arls.show',
            'arls.store',
            'arls.update',

            'clients.store',
            'clients.index',
            'clients.show',

            'profiles-users.show-own',
            'profiles-users.update-own',
            'profiles-clients.show-user',
            'profiles-clients.update',

            'activities.index',
            'activities.show',

            'order_statuses.index',
            'order_statuses.show',

            'service_orders.view',
            'service_orders.view_by_professional',
            'service_orders.view_by_status',
            'service_orders.postpone',
            'service_orders.accept',
            'service_orders.reject',

            'notes.index',
            'notes.store',

            'documents.index',
            'documents.store',
            'documents.approve',
            'documents.reject',

            'notifications.show-own',
            'notifications.mark-as-read',
        ]);
    }
}
