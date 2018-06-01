<?php
/**
 * Created by PhpStorm.
 * User: oana
 * Date: 5/13/2018
 * Time: 2:31 PM
 */

namespace Tests\Feature;

use App\BloodRequest;
use App\Donor;
use App\User;
use App\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BloodRequestTest extends TestCase
{
    use RefreshDatabase;

    private $doctor;
    private $donor;
    private $data = [
        'red_blood_cells_quantity' => 1,
        'thrombocyte_quantity' => 1,
        'plasma_quantity' => 1,
        'blood_type' => 'A',
        'rh' => '+',
        'urgency_level' => 'low',
        'country' => 'abc',
        'city' => 'asdf',
        'street' => 'asF',
        'number' => 123
    ];

    private $data_rbcq_rh_fail = [
        'red_blood_cells_quantity' => 1,
        'thrombocyte_quantity' => 1,
        'plasma_quantity' => 0,
        'blood_type' => 'A',
        'rh' => null,
        'urgency_level' => 'low',
        'country' => 'abc',
        'city' => 'asdf',
        'street' => 'asF',
        'number' => 123
    ];

    private $data_rbcq_blood_type_fail = [
        'red_blood_cells_quantity' => 1,
        'thrombocyte_quantity' => 1,
        'plasma_quantity' => null,
        'blood_type' => null,
        'rh' => '-',
        'urgency_level' => 'low',
        'country' => 'abc',
        'city' => 'asdf',
        'street' => 'asF',
        'number' => 123
    ];

    protected function setUp()
    {
        parent::setUp();

        $this->donor = factory(Donor::class)->create();
        $this->doctor = factory(User::class)->create(['role' => UserType::DOCTOR]);
    }


    /*
    *  DOCTORS: test creation for non doctors
    */
    public function testCreateBloodRequestNotAllowedForDonors()
    {
        $this->actingAs($this->donor->user);
        $this
            ->json('post', '/api/blood/request', $this->data)
            ->assertStatus(403);
    }

    public function testCreateBloodRequestSuccessfully()
    {
        $this->actingAs($this->doctor);
        $this
            ->json('post', '/api/blood/request', $this->data)
            ->assertSuccessful();
    }

    public function testCreateBloodRequestNotAllowedForAssistants()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));
        $this
            ->json('post', '/api/blood/request', $this->data)
            ->assertStatus(403);
    }


    /*
    *  DOCTORS: test creation with invalid data
    */
    public function testRedBloodCellsRequireRh()
    {

        factory(BloodRequest::class, 10)->create();

        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));
        $this
            ->json('get', '/api/blood/requests')
            ->assertSuccessful()->assertJsonCount(10);

        $this->actingAs(factory(User::class)->create(['role' => UserType::DOCTOR]));
        $this
            ->json('post', '/api/blood/request', $this->data_rbcq_rh_fail);

        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));
        $this
            ->json('get', '/api/blood/requests')
            ->assertSuccessful()->assertJsonCount(10);
    }

    public function testRedBloodCellsRequireGroupType()
    {

        factory(BloodRequest::class, 10)->create();

        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));
        $this
            ->json('get', '/api/blood/requests')
            ->assertSuccessful()->assertJsonCount(10);


        $this->actingAs(factory(User::class)->create(['role' => UserType::DOCTOR]));
        $this
            ->json('post', '/api/blood/request', $this->data_rbcq_blood_type_fail);

        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));
        $this
            ->json('get', '/api/blood/requests')
            ->assertSuccessful();
    }


    /*
    *  DOCTORS: test get history of blood requests
    */
    public function testHistoryBloodRequestNotAllowedForAssistants()
    {
        $this->actingAs(factory(User::class)->create(['role' => UserType::ASSISTANT]));

        $this
            ->json('get', '/api/blood/request/history')
            ->assertStatus(403);
    }

    public function testHistoryBloodRequestNotAllowedForDonors()
    {
        $this->actingAs($this->donor->user);
        $this
            ->json('get', '/api/blood/request/history')
            ->assertStatus(403);
    }

    public function testHistoryBloodRequestForSuccess()
    {
        factory(BloodRequest::class, 10)->create();
        $this->actingAs(factory(User::class)->create(['role' => UserType::DOCTOR]));
        $this
            ->json('post', '/api/blood/request', $this->data);
        $this
            ->json('get', '/api/blood/request/history')
            ->assertSuccessful()->assertJsonCount(11);

    }


}