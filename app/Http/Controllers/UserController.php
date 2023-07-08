<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function register(RegistrationRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->getPassword()
        ]);
        $user->generateApiToken();

        return response()->json($user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (!auth()->attempt($request->validated()))
        {
            return response()->json(['status' => 401, 'success' => true, 'message' => 'Incorrect information'], 401);
        }

        $newApiToken = User::whereEmail($request->email)->first()->generateApiToken();

        return response()->json(['api_token' => $newApiToken]);
    }
}
