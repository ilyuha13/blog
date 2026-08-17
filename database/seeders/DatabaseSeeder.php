<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'adminpassword',

        ]);

        $ivan = User::factory()->create([
            'name' => 'Ivan',
            'email' => 'ivan@example.com',
            'password' => 'password',
        ]);

        $alex = User::factory()->create([
            'name' => 'Alex',
            'email' => 'alex@example.com',
            'password' => 'password',
        ]);

        Post::factory(5)->create([
            'user_id' => $ivan->id,
        ]);

        Post::factory(3)->create([
            'user_id' => $alex->id,
        ]);

    }
}
