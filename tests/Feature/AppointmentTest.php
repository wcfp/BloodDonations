<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 5/6/2018
 * Time: 6:29 PM
 */

namespace Tests\Feature;


use App\BloodRequest;
use APP\Http\Controllers;
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
            ->json('post', '/api/appointments', ['date' => Carbon::yesterday()->toDateTimeString()])
            ->assertStatus(400)
            ->assertJson(['message' => "You can't make an appointment for the past"]);
    }

    public function testAppointmentInTheFuture()
    {
        $this->actingAs($this->donor->user);

        $appointmentDate = Carbon::tomorrow()->toDateTimeString();
        $this
            ->json('post', '/api/appointments', ['date' => $appointmentDate])
            ->assertSuccessful();


        $this->assertEquals(Donation::firstOrFail()->appointment_date, Carbon::tomorrow());
        $this->assertEquals(Donation::firstOrFail()->status_date, Carbon::now());
        $this->assertEquals(Donation::firstOrFail()->status, "requested");
    }

    public function testNotAllowedForNonUsers()
    {
        $this
            ->json('post', '/api/appointments', ['date' => Carbon::tomorrow()->toDateTimeString()])
            ->assertStatus(401);
    }

    public function testNotAllowedForNonDonors()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::DOCTOR]));

        $this
            ->json('post', '/api/appointments', ['date' => Carbon::tomorrow()->toDateTimeString()])
            ->assertStatus(403);
    }

    public function testGetAppointmentNotAllowedForNonAssistants()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::DONOR]));

        $this
            ->json('get', '/api/appointments')
            ->assertStatus(403);
    }

    public function testGetAppointmentSuccessful()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));

        factory(Donation::class, 10)->create();
        factory(Donation::class, 1)->create(['status' => 'random']);
        $this
            ->json('get', '/api/appointments')
            ->assertSuccessful()->assertJsonCount(10);
    }

    public function testGetBloodRequestsSuccessful()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));

        factory(BloodRequest::class, 10)->create();
        $this
            ->json('get', '/api/blood/requests')
            ->assertSuccessful()->assertJsonCount(10);
    }

    public function testGetBloodRequestSuccessful()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));

        $bloodRequest = factory(BloodRequest::class)->create();
        $this
            ->json('get', '/api/blood/requests/' . $bloodRequest->id)
            ->assertSuccessful()->assertJson($bloodRequest->toArray());
    }

    public function testChangeBloodRequestStatusSuccessful()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));

        $bloodRequest = factory(BloodRequest::class)->create();

        $this
            ->json('patch', '/api/blood/requests/' . $bloodRequest->id. '/status', ['status' => 'accepted'])
            ->assertSuccessful();

        $this->assertEquals(BloodRequest::find($bloodRequest->id)->status, 'accepted');
    }

    public function testChangeBloodRequestStatusFails()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));

        $bloodRequest = factory(BloodRequest::class)->create();

        $this
            ->json('patch', '/api/blood/requests/' . $bloodRequest->id . '/status', ['status' => 'accepted'])
            ->assertSuccessful();

        $this->assertNotEquals(BloodRequest::find($bloodRequest->id)->status, 'requested');
    }

}