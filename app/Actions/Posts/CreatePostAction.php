<?php

namespace App\Actions\Posts;

use App\Models\Post;
use App\Models\User;

class CreatePostAction
{
    public function execute(
        User $user,
        string $title,
        string $text,
    ): Post {
        return $user->posts()->create([
            'title' => $title,
            'text' => $text,
        ]);
    }
}