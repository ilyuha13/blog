<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Actions\Auth\LoginUserAction;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request, LoginUserAction $action): JsonResponse {
        $result = $action->execute(
            email: $request->validated('email'),
            password: $request->validated('password'),
        );

        return response()->json([
            'access_token' => $result['access_token'],
            'user' => new UserResource($result['user']),
        ]);

    }
}
