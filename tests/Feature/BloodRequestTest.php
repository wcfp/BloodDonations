<?php
/**
 * Created by PhpStorm.
 * User: oana
 * Date: 5/13/2018
 * Time: 2:31 PM
 */

namespace Tests\Feature;

use App\Donor;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BloodRequestTest  extends TestCase
{
    use RefreshDatabase;
    
    private $doctor;
    private $donor;
    private $data = [
        'red_blood_cells_quantity' => null,
        'thrombocyte_quantity' => 1,
        'plasma_quantity' => 0,
        'blood_type' => 'A',
        'rh' => '+',
        'urgency_level'=>'low',
        'country'=>'abc',
        'city'=>'asdf',
        'street'=>'asF',
        'number'=> 123
    ];
    protected function setUp()
    {
        parent::setUp();

        $this->donor = factory(Donor::class)->create();
        $this->doctor = factory(User::class)->create();
    }
    public function testNotAllowedForNonDonors()
    {
        $this->actingAs($this->donor->user);
        $this
            ->json('post', '/api/blood/request', $this->data)
            ->assertStatus(403);
    }

}