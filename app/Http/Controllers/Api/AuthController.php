<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        Log::info('Login attempt for: ' . $request->email);

        $user = \App\Models\User::where('email', $request->email)->first();


        if (!$user) {
            Log::warning('User not found for email: ' . $request->email);
            return response()->json(['message' => 'Invalid credentials (email not found)'], 401);
        }

       
        if (!Hash::check($request->password, $user->password)) {
            Log::warning('Password mismatch', [
                'input_password' => $request->password,
                'stored_hash' => $user->password
            ]);
            return response()->json(['message' => 'Invalid credentials (password mismatch)'], 401);
        }
      



        Log::info('Login successful for user ID: ' . $user->id);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $user->only(['id', 'name', 'email']),
            'token' => base64_encode($user->email . '|' . now()),
        ]);
    }
}
