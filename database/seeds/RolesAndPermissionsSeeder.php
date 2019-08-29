<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // listado de permisos
        $permissions = [
            // crud roles
            'list-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            // crud usuarios
            'list-users',
            'create-users',
            'edit-users',
            'delete-users',
            // crud instituciones
            'list-institutions',
            'create-institutions',
            'edit-institutions',
            'delete-institutions',
            // crud hitos
            'list-milestones',
            'create-milestones',
            'edit-milestones',
            'delete-milestones',
            // crud cumplimientos
            'list-fulfillments',
            'create-fulfillments',
            'edit-fulfillments',
            'delete-fulfillments',
         ];

        // creando permisos a partir de listado
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // creado un rol superadmin y asignado todos los permisos
        $all_permissions = Permission::pluck('id', 'id')->all();

        Role::create(['name' => 'Super Admin'])
            ->syncPermissions($all_permissions);


        // creado un rol oficial de SI y asignado permisos correspondientes
        Role::create(['name' => 'Oficial de Seguridad de la Información'])
            ->givePermissionTo([
                // crud cumplimientos
                'list-fulfillments',
                'create-fulfillments',
                'edit-fulfillments',
                'delete-fulfillments',
            ]);

        // creado un rol evaluador del mintel y asignado permisos correspondientes
        Role::create(['name' => 'Evaluador del Mintel'])
            ->givePermissionTo([
                // crud instituciones
                'list-institutions',
                'create-institutions',
                'edit-institutions',
                'delete-institutions',
                // crud hitos
                'list-milestones',
                'create-milestones',
                'edit-milestones',
                'delete-milestones',
                // crud cumplimientos
                'list-fulfillments',
            ]);
    }
}
