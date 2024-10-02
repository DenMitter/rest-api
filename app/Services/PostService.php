<?php
namespace App\Services;

use App\Models\Post;
use Exception;

class PostService {
    /**
     * @throws Exception
     */
    public function show($id): array
    {
        $post = Post::query()->where('id', $id)->first();

        if (empty($post)) {
            throw new Exception('', 404);
        }

        return [
            'post' => $post
        ];
    }

    public function update($data, $id): array
    {
        $post = Post::query()->where('id', $id)->first();
        $post->update($data);

        return [
            'post' => $post
        ];
    }

    /**
     * @throws Exception
     */
    public function destroy($id): array
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
