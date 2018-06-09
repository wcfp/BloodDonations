<?php

use Illuminate\Database\Seeder;

class BloodContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BloodContainer::class, 60)->create();
    }
}
