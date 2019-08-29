<?php

 // funciones de ayuda
 function crear_superadmin()
 {

    $user = factory(App\User::class)->create();

    $user->assignRole('Super Admin');

    return $user;
 }

function crear_usuario_regular()
{
    $user = factory(\App\User::class)->create();

    $user->assignRole('Oficial de Seguridad de la Información');

    return $user;
}

function crear_permisos()
{
    $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
     ];

     foreach ($permissions as $permission) {
          \App\Permission::create(['name' => $permission]);
     }
}
