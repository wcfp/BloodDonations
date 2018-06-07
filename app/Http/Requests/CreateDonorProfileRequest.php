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
            'cnp'=>'required|string',
            'phone_number' => ['required', 'regex:/\d+/'],
            'weight' => 'required|numeric',
            'birth_date' => 'required|date',
            'current_country' => 'required|string',
            'current_city' => 'required|string',
            'current_street' => 'required|string',
            'current_number' => 'required|string',
            'residence_country' => 'required_if:residence_address,true|string|nullable',
            'residence_number' => 'required_if:residence_address,true|string|nullable',
            'residence_city' => 'required_if:residence_address,true|string|nullable',
            'residence_street' => 'required_if:residence_address,true|string|nullable',
        ];
    }
}
