<?php

namespace App\Http\Requests;

use App\UserType;
use Illuminate\Foundation\Http\FormRequest;

class CreateDonorProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role == UserType::DONOR;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'blood_type' => 'in:A,B,AB,0',
            'rh' => 'in:+,-',
            'phone_number' => 'required|regex:\d+',
            'weight' => 'required|number',
            'birth_date' => 'required|date',
            'current_country' => 'required|string',
            'current_city' => 'required|string',
            'current_street' => 'required|string',
            'current_number' => 'required|number',
            'residence_country' => 'required_with:residence_address|string',
            'residence_number' => 'required_with:residence_address|number',
            'residence_city' => 'required_with:residence_address|string',
            'residence_street' => 'required_with:residence_address|string',
        ];
    }
}
