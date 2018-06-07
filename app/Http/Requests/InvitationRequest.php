<?php
/**
 * Created by PhpStorm.
 * User: agavrila
 * Date: 2018-05-13
 * Time: 3:51 PM
 */

namespace App\Http\Requests;


use App\UserType;
use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->role == UserType::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:ASSISTANT,DOCTOR'
        ];
    }

}