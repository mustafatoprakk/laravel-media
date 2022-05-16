<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view("posts.index", compact("posts"));
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->validated());
        $post->addMediaFromRequest("image")->usingName($post->title)->toMediaCollection();
    }

    public function show()
    {
        $posts = Post::all();
        return view("posts.index", compact("posts"));
    }

    public function edit(Post $post)
    {
        return view("posts.edit", compact("post"));
    }

    public function update(PostCreateRequest $request, Post $post)
    {
        $post->update($request->validated());
        if ($request->hasFile("image")) {
            $post->clearMediaCollection();
            $post->addMediaFromRequest("image")->usingName($post->title)->toMediaCollection();
        }
        return to_route("posts.index");
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        $post->clearMediaCollection("image");
        return to_route("posts.index");
    }
}
