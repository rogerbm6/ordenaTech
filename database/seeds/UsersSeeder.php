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
        factory(App\User::class)->times(5)->create();

        Role::create([
          'name'    => 'Admin',
          'slug'    => 'admin',
          'special' => 'all-access'
        ]);

        //crea usuario
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

        //crea de prueba

        $user1 = new User();
        $user1->name = "User";
        $user1->email = "user@user.com";
        $user1->email_verified_at = now();
        //password
        $user1->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user1->remember_token = Str::random(10);
        $user1->save();

        $user1->roles()->attach($role);

    }
}
