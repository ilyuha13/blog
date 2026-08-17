<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostIndexRequest;
use App\Actions\Posts\ListPostsAction;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;


class PostIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PostIndexRequest $request, ListPostsAction $action): JsonResponse
    {
        $posts = $action->execute(
            limit: $request->limit(),
            offset: $request->offset(),
            dateFrom: $request->dateFrom(),
            dateTo: $request->dateTo(),
            sortBy: $request->sortBy(),
            sortDirection: $request->sortDirection(),
        );

        return response()->json([
            'data' => PostResource::collection($posts['items']),
            'meta' => [
                'total' => $posts['total'],
                'limit' => $posts['limit'],
                'offset' => $posts['offset'],
            ],
        ]);
    }
}
