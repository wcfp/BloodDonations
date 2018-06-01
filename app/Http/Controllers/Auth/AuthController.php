<?php

namespace App\Http\Controllers\Auth;

use App\Donor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\User;
use App\UserType;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'surname']);
        $user = User::make($data);
        $user->role = UserType::DONOR;
        $user->password = Hash::make($request->password);

        if (!$user->save()) {
            return response()->json("User cannot be saved", 500);
        }

        $user = $user->refresh();
        factory(Donor::class)->create(['user_id' => $user->id]);

        return $this->respondWithToken(auth()->login($user));
    }
}
