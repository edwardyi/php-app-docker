<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        // $data = Post::find($post);

        // return $data;

        return view('welcome', compact('post'));
    }
}
