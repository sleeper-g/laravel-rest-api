<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TokenController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Неверные учетные данные'
            ], 401);
        }

        $token = $user->createToken($data['device_name'])->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }
}
