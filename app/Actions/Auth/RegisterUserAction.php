<?php

namespace App\Actions\Auth;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    public function execute(
        string $name,
        string $email,
        string $password,
    ): array {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        $user->role = UserRole::USER;
        $user->save();

        $token = $user->createToken('mobile')->plainTextToken;

        return [
            'user' => $user,
            'access_token' => $token,
        ];
    }
}

