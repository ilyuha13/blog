<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Actions\Auth\RegisterUserAction;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        RegisterRequest $request,
        RegisterUserAction $action,
        ): JsonResponse {
            $result = $action->execute(
               name: $request->validated('name'),
                email: $request->validated('email'),
                password: $request->validated('password'), 
            );

            return response()->json([
                'access_token' => $result['access_token'],
                'user' => new UserResource($result['user']),
            ], 201);
    }
}
