<?php
namespace App\Services;

use App\Models\Post;
use Exception;

class PostService {
    public function show($id)
    {
        $post = Post::query()->where('id', $id)->first();

        if (empty($post)) {
            throw new Exception('', 404);
        }

        return [
            'post' => $post
        ];
    }

    public function update($data, $id)
    {
        $post = Post::query()->where('id', $id)->first();
        $post->update($data);

        return [
            'post' => $post
        ];
    }

    public function destroy($id)
    {
        $post = Post::query()->where('id', $id)->first();

        if (empty($post) || $post->comments()->first()) {
            throw new Exception('', 400);
        }

        $post->delete();

        return [
            'post' => $post
        ];
    }
}