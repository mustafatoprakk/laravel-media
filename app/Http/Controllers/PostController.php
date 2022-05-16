<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view("posts.create");
    }

    public function store(PostCreateRequest $request)
    {
        Post::create($request->validated());
    }
}
