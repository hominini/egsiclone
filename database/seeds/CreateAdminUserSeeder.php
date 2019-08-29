<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'bperez',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'nombres' => 'Byron',
            'apellidos' => 'Pérez Vega',
            'cedula' => '1723749501',
            'cargo' => 'Super Administrador',
            'area' => 'Departamento de Tecnología',
            'institucion_id' => 2,
        ]);

        $user->assignRole('Super Admin');
    }
}
