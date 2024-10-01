<?php
namespace App\Services;

use App\Models\Post;

class PostService {
    public function index() 
    {
        $posts = Post::query()->orderBy('id', 'desc')->paginate(10);
        
        return response()->json([
            'success' => true,
            'data' => [
                'posts' => $posts
            ]
        ]);
    }

    public function store($request)
    {
        $data = $request->validated();
        $post = Post::query()->create($data);

        return response()->json([
            'success' => true,
            'data' => [
                'post' => $post
            ]
        ], 200);
    }

    public function show($id)
    {
        $post = Post::query()->where('id', $id)->first();

        if (empty($post)) {
            return response()->json([
                'success' => false
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'post' => $post
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

        $post = Post::query()->where('id', $id)->first();
        $post->update($data);

        return response()->json([
            'success' => true,
            'data' => [
                'post' => $post
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $post = Post::query()->where('id', $id)->first();
        
        if (empty($post) || $post->comments()->first()) {
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