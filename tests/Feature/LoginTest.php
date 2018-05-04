<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    private $user;

    public function testLoginReturnsJWT()
    {
        $this
            ->json('post', '/api/auth/login', ['email' => $this->user->email, 'password' => 'password'])
            ->assertSuccessful()
            ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    public function testMeReturnsUser()
    {
        $token = $this->json('post', '/api/auth/login', ['email' => $this->user->email, 'password' => 'password'])->json('access_token');
        $this->json('get', '/api/auth/me', [], ['Authorization' => "Bearer ${token}"])
            ->assertSuccessful()
            ->assertJson($this->user->toArray());

    }

    public function testLogout()
    {
        $this->json('post', '/api/auth/logout')
            ->assertStatus(401);

        $this->actingAs($this->user);
        $this->assertNotNull(auth()->user());

        $this
            ->json('post', 'api/auth/logout', [], ['Authorization' => "Bearer ". auth()->tokenById($this->user->id)])
            ->assertJson(['message' => 'Successfully logged out']);

        $this->assertNull(auth()->user());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create(['email' => 'test@login . com', 'password' => Hash::make("password")]);
    }
}
