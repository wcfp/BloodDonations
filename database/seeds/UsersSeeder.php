<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create(['email' => 'admin@bdms.com', 'role' => 'ADMIN']);
        factory(App\User::class, 5)->create(['role' => 'DONOR']);
        factory(App\User::class, 5)->create(['role' => 'ASSISTANT']);
        factory(App\User::class, 5)->create(['role' => 'DOCTOR']);
    }
}
