<?php
/**
 * Created by PhpStorm.
 * User: oana
 * Date: 5/13/2018
 * Time: 1:29 PM
 */

namespace App\Http\Requests;


use App\UserType;
use Illuminate\Foundation\Http\FormRequest;


class BloodFormRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role == UserType::DOCTOR;
    }

    public function rules()
    {
        return [
            'red_blood_cells_quantity' => 'required_without_all:thrombocyte_quantity,plasma_quantity|numeric|nullable',
            'thrombocyte_quantity' => 'required_without_all:red_blood_cells_quantity,plasma_quantity|numeric|nullable',
            'plasma_quantity' => 'required_without_all:thrombocyte_quantity,red_blood_cells_quantity|numeric|nullable',
            'blood_type' => 'nullable|required_with:red_blood_cells_quantity|in:A,B,AB,0',
            'rh' => 'nullable|required_with:red_blood_cells_quantity|in:+,-',
            'urgency_level' => 'in:low,medium,high|required_without:cnp|nullable',
            'country' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|numeric',
            'cnp' => 'nullable|string'
        ];
    }

}