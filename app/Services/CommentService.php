<?php
namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Exception;

class CommentService {
    public function store($data)
    {
        if (empty(Post::query()->where('id', $data['post_id'])->first())) {
            throw new Exception('Invalid post ID', 404);
        }

        $comment = Comment::query()->create($data);

        return [
            'comment' => $comment
        ];
    }

    public function show($id)
    {
        $comment = Comment::query()->where('id', $id)->first();

        if (empty($comment)) {
            throw new Exception('', 404);
        }

        return [
            'comment' => $comment
        ];
    }

    public function update($request, $id)
    {
        $data = $request->validated();

        if (empty($data)) {
            throw new Exception('', 400);
        }

        $comment = Comment::query()->where('id', $id)->first();
        $comment->update($data);

        return [
            'comment' => $comment
        ];
    }

    public function destroy($id)
    {
        $post = Comment::query()->where('id', $id)->first();
        
        if (empty($post)) {
            throw new Exception('', 400);
        }

        $post->delete();

        return true;
    }
}