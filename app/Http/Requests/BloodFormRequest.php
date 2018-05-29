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
            'red_blood_cells_quantity' => 'required_without:thrombocyte_quantity,plasma_quantity|numeric',
            'thrombocyte_quantity' => 'required_without:red_blood_cells_quantity,plasma_quantity|numeric',
            'plasma_quantity' => 'required_without:thrombocyte_quantity,red_blood_cells_quantity|numeric',
            'blood_type' => 'required_with:red_blood_cells_quantity|in:A,B,AB,0',
            'rh' => 'required_with:red_blood_cells_quantity|in:+,-',
            'urgency_level' => 'in:low,medium,high|required',
            'country' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|numeric',
        ];
    }

}