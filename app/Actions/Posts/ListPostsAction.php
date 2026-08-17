<?php

namespace App\Actions\Posts;

use App\Models\Post;



class ListPostsAction 
{
    public function execute(
        int $limit = 10,
        int $offset = 0,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        string $sortBy = 'created_at',
        string $sortDirection = 'desc',
    ): array {
        $query = Post::query();

        if ($dateFrom) {
            $query->where('created_at', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->where('created_at', '<=', $dateTo);
        }

        $total = (clone $query)->count();

        $posts = $query->orderBy($sortBy, $sortDirection)
            ->orderBy('id', $sortDirection)
            ->offset($offset)
            ->limit($limit)
            ->get();

        return [
            'items' => $posts,
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
        ];
    }
}