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
            'residence_country' => 'required|string',
            'residence_city' => 'required|string',
            'residence_street' => 'required|string',
            'residence_number' => 'required|number',
            'current_country' => 'required_with:current_address|string',
            'current_number' => 'required_with:current_address|number',
            'current_city' => 'required_with:current_address|string',
            'current_street' => 'required_with:current_address|string',
        ];
    }
}
