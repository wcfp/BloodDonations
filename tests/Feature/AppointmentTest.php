<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5/6/2018
 * Time: 6:29 PM
 */

namespace Tests\Feature;


use App\Donation;
use App\Donor;
use App\User;
use App\UserType;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;
    private $donor;

    protected function setUp()
    {
        parent::setUp();

        $this->donor = factory(Donor::class)->create();
    }

    public function testAppointmentInThePastFails()
    {
        $this->actingAs($this->donor->user);

        $this
            ->json('post', '/api/appointment', ['date' => Carbon::yesterday()->toDateTimeString()])
            ->assertStatus(400)
            ->assertJson(['message' => "You can't make an appointment for the past"]);
    }

    public function testAppointmentInTheFuture()
    {
        $this->actingAs($this->donor->user);

        $appointmentDate = Carbon::tomorrow()->toDateTimeString();
        $this
            ->json('post', '/api/appointment', ['date' => $appointmentDate])
            ->assertSuccessful();


        $this->assertEquals(Donation::firstOrFail()->appointment_date, Carbon::tomorrow());
        $this->assertEquals(Donation::firstOrFail()->status_date, Carbon::now());
        $this->assertEquals(Donation::firstOrFail()->status, "requested");
    }

    public function testNotAllowedForNonUsers()
    {
        $this
            ->json('post', '/api/appointment', ['date' => Carbon::tomorrow()->toDateTimeString()])
            ->assertStatus(401);
    }

    public function testNotAllowedForNonDonors()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::DOCTOR]));

        $this
            ->json('post', '/api/appointment', ['date' => Carbon::tomorrow()->toDateTimeString()])
            ->assertStatus(403);
    }
}