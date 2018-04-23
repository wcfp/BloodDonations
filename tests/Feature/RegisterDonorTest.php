<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterDonorTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data = [
            'name' => "andrei",
            'surname' => 'gavrila',
            'email' => 'email@test2.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $this->post("/api/register", $data)->assertSuccessful();
        $this->assertEquals(1, User::count());
    }
}
