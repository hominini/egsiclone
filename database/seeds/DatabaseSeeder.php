<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(InstitutionsSeeder::class);
        $this->call(MilestonesSeeder::class);
        $this->call(CategoriesSeeder::class);
    }
}
