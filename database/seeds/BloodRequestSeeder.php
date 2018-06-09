<?php

use Illuminate\Database\Seeder;

class BloodRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BloodRequest::class, 10)->create();
    }
}