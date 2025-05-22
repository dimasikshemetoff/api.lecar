<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Получение списка пользователей
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Создание нового пользователя
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users', // Добавляем
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'nullable|string|max:20',
        'password' => 'required|string|min:8',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    $user = User::create($validatedData);

    return response()->json($user, 201);
}

public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'full_name' => 'sometimes|string|max:255',
        'username' => [ // Добавляем
            'sometimes',
            'string',
            'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
        'email' => [
            'sometimes',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id),
        ],
        'phone' => 'nullable|string|max:20',
        'password' => 'sometimes|string|min:8',
    ]);

    if (isset($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    }

    $user->update($validatedData);

    return response()->json($user);
}

    // Удаление пользователя
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}