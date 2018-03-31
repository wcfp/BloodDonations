<?php

use Illuminate\Database\Seeder;

class DonorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Donor::class, 10)->create();
    }
}
