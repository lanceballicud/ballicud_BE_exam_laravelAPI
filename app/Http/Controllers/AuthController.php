<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($validated);

        $token = $user->createToken($request->name);

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            // 'email' => 'required|email|exists:users',
            'password' => 'required',
            
            'remember' => 'boolean',
        ]);

        // $user = User::where('email', $request->email)->first();

        $user = User::where('email', $request->identifier)
                ->orWhere('name', $request->identifier)
                ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return response()->json([
                'errors' => [
                    'message' => ['The provided credentials are incorrect'],
                ]
            ], 401);
        }


        // $token = $user->createToken($user->name);

        // return response()->json([
        //     'user' => $user,
        //     'token' => $token->plainTextToken
        // ]);

        $remember = $request->remember ?? false;

        $token = $remember
        ? $user->createToken($user->name, ['*'], now()->addWeeks(2)) // Token valid for 2 weeks
        : $user->createToken($user->name);

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'You are logged out.'
        ]);
    }
}
