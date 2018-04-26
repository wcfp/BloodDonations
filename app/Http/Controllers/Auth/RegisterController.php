<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\User;
use App\UserType;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'surname', 'role']);
        $user = User::make($data);
        $user->role = UserType::DOCTOR;
        $user->password = Hash::make($request->password);

        if (!$user->save()) {
            return response()->json("User cannot be saved", 500);
        }
        return ['message' => 'User created'];
    }

}