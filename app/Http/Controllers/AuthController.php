<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        return response()->json(['message' => 'User created!'], '201');
    }

    public function signIn(Request $request) {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json('User not found.', '404');
        }

        $passwordMatches = Hash::check($validated['password'], $user['password']);

        if (!$passwordMatches) {
            return response()->json('Passwords do not match.', '409');
        }

        $token = $user->createToken('sct:tkn')->plainTextToken;

        return response()->json(['message' => "You're logged in!", 'token' => $token], '200');
    }
}
