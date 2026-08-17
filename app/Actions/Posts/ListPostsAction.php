<?php

namespace App\Actions\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;



class ListPostsAction 
{
    public function execute(
        int $limit = 10,
        int $offset = 0,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        string $sortBy = 'created_at',
        string $sortDirection = 'desc',
        ?User $user = null
    ): array {
        $query = Post::query();

        if ($user) {
            $user_id = $user->id;
            $query->where('user_id', $user_id);
        }

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