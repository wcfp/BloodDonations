<?php

namespace App\Http\Controllers\Auth;

use App\Donor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\InvitationRegisterRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Invitation;
use App\User;
use App\UserType;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'invitationRegister']]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->all(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['errors' => ['Invalid username/password']], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
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
            return response()->json(["errors" => ["User cannot be saved"]], 500);
        }

        $user = $user->refresh();

        return $this->respondWithToken(auth()->login($user));
    }

    public function invitationRegister(InvitationRegisterRequest $request)
    {
        $invitation = Invitation::where('token', $request->token)->firstOrFail();

        $data = $request->only(['name', 'surname']);
        $user = User::make($data);
        $user->email = $invitation->email;
        $user->role = $invitation->role;
        $user->password = Hash::make($request->password);

        if (!$user->save()) {
            return response()->json(["errors" => ["User cannot be saved"]], 500);
        }

        $user = $user->refresh();
        $invitation->update(['used' => true]);
        return $this->respondWithToken(auth()->login($user));
    }
}
