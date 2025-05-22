<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Регистрация пользователя
    public function register(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'phone' => 'nullable|string|max:20',
    ]);

    $user = User::create([
        'full_name' => $request->full_name,
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
    ]);

    // Используем createToken вместо generateToken
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ], 201);
}

public function login(Request $request)
{
    $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->login)
                ->orWhere('username', $request->login)
                ->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Неверные учетные данные'
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
}

public function logout(Request $request)
{
    // Удаляем все токены пользователя
    $request->user()->tokens()->delete();
    
    return response()->json([
        'message' => 'Успешный выход из системы'
    ]);
}

    // Получение текущего пользователя
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}