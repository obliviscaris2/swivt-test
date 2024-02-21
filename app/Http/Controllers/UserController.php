<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'secret_question' => 'required',
            'secret_answer' => 'required'
        ]);

        // Create new user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'secret_question' => $request->secret_question,
            'secret_answer' => Hash::make($request->secret_answer),
        ]);

        return response()->json(['message' => 'User registered successfully']);
    }

    public function login(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Create a Personal Access Token for the authenticated user
            $token = Passport::token();

            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function verifySecret(Request $request)
    {
        // Validate request data
        $request->validate([
            'secret_answer' => 'required',
        ]);

        // Retrieve authenticated user
        $user = Auth::user();

        // Compare provided answer with hashed answer stored in the database
        if (Hash::check($request->secret_answer, $user->secret_answer)) {
            return response()->json(['message' => 'Secret question verified successfully']);
        } else {
            return response()->json(['error' => 'Incorrect secret answer'], 401);
        }
    }

    public function changePassword(Request $request)
    {
        // Validate request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        // Retrieve authenticated user
        $user = Auth::user();

        // Check if the current password matches the user's stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 401);
        }

        // Update user's password with the new password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully']);
    }
}
