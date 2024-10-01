<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Services\PostService;
use App\Models\Post;
use Exception;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

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
        try {
            $data = $this->postService->show($id);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false
            ], $exception->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        try {
            $data = $this->postService->update($request->validated(), $id);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false
            ], $exception->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = $this->postService->destroy($id);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false
            ], $exception->getCode());
        }
    }
}