<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::query()->limit(50)->get(['id']);

        Comment::unguard();
        for($i = 0; $i < 100; $i++) {
            Comment::query()->create([
                'post_id' => $posts->random()->id,
                'contents' => fake()->sentence(10),
            ]);
        }
        Comment::reguard();
    }
}
