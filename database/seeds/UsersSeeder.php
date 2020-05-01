<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->times(10)->create();

        Role::create([
          'name'    => 'Admin',
          'slug'    => 'admin',
          'special' => 'all-access'
        ]);

    }
}
