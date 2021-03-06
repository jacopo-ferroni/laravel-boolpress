<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\Tag;
use Symfony\Component\VarDumper\Cloner\Data;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        // return view('posts archive');
        $tags = Tag::all();

        dump($tags);

        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();


        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',

        ]);

        $data = $request->all();

        // AGGIUNTA IMAGUEN SE PRESENTE
        if(array_key_exists('cover', $data)) {
            // salva immagine in strorage e ottenere la path del file caricato da salvare db
            $img_path = Storage::put('posts-covers', $data['cover']);
            $data['cover'] = $img_path;
        }

        // Create a new post
        $new_post = new Post();

        // Generate a unique slug
        $slug = Str::slug($data['title'], '-');
        $count = 1;

        // Loop in case of equal slugs
        while(Post::where('slug', $slug)->first()) {
            $slug .= '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        $new_post->fill($data);

        $new_post->save();

        // Save into bridge table relation between new post with tag selected on form

        if(array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(! $post) {
            abort(404);
        } elseif ($post->cover) {
            $post->cover = url('storage/' . $post->cover);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        if(! $post) {
            abort(404);
        }

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ]);

        $data = $request->all();

        // Update
        $post = Post::find($id);

        // Aggiunta/Update foto se gi?? presente
        if (array_key_exists('cover', $data)) {
            // remove if cover already exist
            if($post->cover) {
                Storage::delete($post->img);
            }
            
            $data['cover'] = Storage::put('posts-covers', $data['cover']);
        }

        // Slug update ONLY IF already exists

        if($data['title'] != $post->title) {
            $slug = Str::slug($data['title'], '-');
            $count = 1;
            $base_slug = $slug;

        // Loop if slug already exists
        while(Post::where('slug', $slug)->first()) {
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        $data['slug'] = $slug;

        }
        else {
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        // Update relationship between updates posts and updates tags
        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post->cover) {
            Storage::delete($post->cover);
        }
        
        $post->delete();

        $post->tags()->detach();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }


    /* 
    * VALIDATION RULE 
    */
    private function validation_rules() {
        return [
            'title' => 'required|maxx:255',
            'content' => 'required',
            'category_id' => 'nullable!exists:categories,id',
            'tags' => 'nullable|exists:tags, id',
            'cover' => 'nullable|file|mimes:jpeg,bmp,png'
        ];
    }

    private function validation_messages() {
        return [
            'required' => 'The :attribute is a required filed!',
            'max' => 'Max :max characters allowed for the :attribute',
            'required' => 'The selected category does not exists.',
        ];
    }
}
