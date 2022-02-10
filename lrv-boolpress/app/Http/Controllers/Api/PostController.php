<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        return response()->json($posts);
    }

    /* post details */
    public function show($slug) {
        // prendere post per slug
        $post = Post::where('slug', $slug)->first();

        // ritorno dati in json
        return response()->json($post);
    }
}
