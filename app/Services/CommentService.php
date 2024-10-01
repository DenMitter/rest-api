<?php
namespace App\Services;

use App\Models\Comment;
use App\Models\Post;

class CommentService {
    public function index() 
    {
        $comments = Comment::query()->orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => [
                'comments' => $comments
            ]
        ]);
    }

    public function store($request)
    {
        $data = $request->validated();

        if (empty(Post::query()->where('id', $data['post_id'])->first())) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid post ID'
            ], 404);
        }

        $comment = Comment::query()->create($data);

        return response()->json([
            'success' => true,
            'data' => [
                'comment' => $comment
            ]
        ], 200);
    }

    public function show($id)
    {
        $comment = Comment::query()->where('id', $id)->first();

        if (empty($comment)) {
            return response()->json([
                'success' => false
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'comment' => $comment
            ]
        ], 200);
    }

    public function update($request, $id)
    {
        $data = $request->validated();

        if (empty($data)) {
            return response()->json([
                'success' => false
            ], 400);
        }

        $comment = Comment::query()->where('id', $id)->first();
        $comment->update($data);

        return response()->json([
            'success' => true,
            'data' => [
                'comment' => $comment
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $post = Comment::query()->where('id', $id)->first();
        
        if (empty($post)) {
            return response()->json([
                'success' => false
            ], 400);
        }

        $post->delete();

        return response()->json([
            'success' => true
        ], 200);
    }
}