<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Actions\Posts\CreatePostAction;
use App\Http\Resources\PostResource;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CreatePostRequest $request, CreatePostAction $createPostAction): JsonResponse

    {
        $post = $createPostAction->execute(
            user: $request->user(),
            title: $request->validated('title'),
            text: $request->validated('text'),
        );

        return response()->json(
            new PostResource($post), 
            201
        );
    }
}
