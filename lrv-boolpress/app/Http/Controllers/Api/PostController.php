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
        // A. prendere post per slug
        $post = Post::where('slug', $slug)->first();

        // B: prendere post per tags o category, di base vedendo i collegamenti dagli altri DB
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();

        // ritorno dati in json
        return response()->json($post);
    }
}
