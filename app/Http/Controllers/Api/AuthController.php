<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // POST /api/register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:120'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'user_type' => 'customer', 
        ]);

        // create a personal access token
        $abilities = ['*'];
        $token = $user->createToken($request->header('X-Device-Name', 'api-client'), $abilities)->plainTextToken;

        return response()->json([
            'message'   => 'Registered Successfully.',
            'token'     => $token,
            'user'      => $user,
        ], 201);
    }

    // POST /api/login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required', 'string'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials.'], 422);
        }

        $abilities = $user->user_type === 'admin' ? ['*'] : ['customer'];
        $deviceName = $request->header('X-Device-Name', $request->userAgent() ?? 'api-client');

        $token = $user->createToken($deviceName, $abilities)->plainTextToken;

        return response()->json([
            'message'   => 'Logged In',
            'token'     => $token,
            'user'      => $user,
        ]);
    }

    // POST /api/logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged Out']);
    }

}
