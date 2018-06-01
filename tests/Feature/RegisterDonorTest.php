<?php

namespace Tests\Feature;

use App\User;
use App\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterDonorTest extends TestCase
{
    use RefreshDatabase;

    private $data = [
        'name' => "andrei",
        'surname' => 'gavrila',
        'email' => 'email@test2.com',
        'password' => 'password',
        'password_confirmation' => 'password'
    ];

    public function testRegisteredUserBecomesDonor()
    {
        $this->assertFalse(User::whereRole(UserType::DOCTOR)->exists());
        $this->json('post', "/api/auth/register", $this->data)
            ->assertSuccessful();

        $user = User::first();
        $this->assertNotNull($user);
        $this->assertEquals(UserType::DOCTOR, $user->role);
        $this->assertEquals($this->data['name'], $user->name);
        $this->assertEquals($this->data['surname'], $user->surname);
        $this->assertEquals($this->data['email'], $user->email);
    }

    public function testPasswordIsHashed()
    {
        $this->json('post', "/api/auth/register", $this->data)->assertSuccessful();
        $this->assertTrue(Hash::check($this->data['password'], User::first()->password));
    }

    public function testRegisterValidations()
    {
        $this->json('post', "/api/auth/register")->assertJsonValidationErrors([
            'email', 'name', 'surname', 'password'
        ]);


        $this->json('post', "/api/auth/register", collect($this->data)->except('password_confirmation')->toArray())
            ->assertJsonValidationErrors(['password']);


        $this->json('post', "/api/auth/register", $this->data)->assertSuccessful();
        auth()->logout();
        $this->json('post', "/api/auth/register", $this->data)->assertJsonValidationErrors(['email']);
    }

    public function testLoggedInAfterRegister()
    {
        $this->json('post', '/api/auth/register', $this->data)->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }
}
