<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostIndexRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;
use App\Actions\Posts\MineListPostAction;


class MinePostIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PostIndexRequest $request, MineListPostAction $action): JsonResponse
    {
        $posts = $action->execute(
            userId: $request->user()->id,
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
