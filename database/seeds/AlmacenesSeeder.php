<?php

use Illuminate\Database\Seeder;

class AlmacenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Almacene::class)->times(10)->create();
    }
}
