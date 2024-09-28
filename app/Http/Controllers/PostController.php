<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::query()->where('id', $id)->first();
        
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
