<?php

namespace Tests\Feature;

use App\User;
use App\UserType;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloodContainerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateBloodContainerAllowedForAssistants()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));
        $this
            ->json('get', '/api/assistant/containers')
            ->assertSuccessful();
    }

    public function testCreateBloodContainerNotAllowedForDonors()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::DONOR]));
        $this
            ->json('get', '/api/assistant/containers')
            ->assertStatus(403);
    }
}
