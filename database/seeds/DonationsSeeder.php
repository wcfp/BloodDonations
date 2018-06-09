<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09-Jun-18
 * Time: 5:36 PM
 */
use Illuminate\Database\Seeder;

class DonationsSeeder extends Seeder
{
    public function run(){
        factory(App\Donation::class, 10)->create();

    }
}