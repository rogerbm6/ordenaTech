<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;

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
        $role=Role::find(1);

        $user = new User();
        $user->name = "Roger";
        $user->email = "roger@roger.com";
        $user->email_verified_at = now();
        //password
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->remember_token = Str::random(10);
        $user->save();

        $user->roles()->attach($role);

    }
}
