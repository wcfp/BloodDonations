<?php
/**
 * Created by PhpStorm.
 * User: oana
 * Date: 5/24/2018
 * Time: 1:35 PM
 */

namespace Tests\Feature;


use App\Donation;
use App\Donor;
use App\User;
use App\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonorHistoryTest extends TestCase
{
    use RefreshDatabase;
    private $donor;

    public function testDoctorNotAllowedForDonorAppointments()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::DOCTOR]));

        $this
            ->json('get', '/api/donor/appointments')
            ->assertStatus(403);
    }

    public function testDoctorNotAllowedForAssistantAppointments()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::DOCTOR]));

        $this
            ->json('get', '/api/assistant/appointments')
            ->assertStatus(403);
    }

    public function testGetAppointmentSuccessful()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));
        factory(Donation::class, 10)->create();


        factory(Donation::class, 1)->create(['status' => 'random']);
        $this
            ->json('get', '/api/assistant/appointments')
            ->assertSuccessful()->assertJsonCount(10);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->donor = factory(Donor::class)->create();
    }


}