@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Blog Posts</h1>

        @if (session('deleted'))
        <div class="alert alert-success">
            <strong>{{ session('deleted') }}</strong> successfully deleted!
        </div>
            
        @endif

            @if($posts ->isEmpty())
            <p>No post found yet.</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if($post->category)
                            <a href="{{ route('admin.category', $post->category->id) }}">{{ $post->category->name }} </a>
                            @else Uncategorized 
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">Show</a>
                        </td>
                        <td><a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input class="btn btn-danger" type="submit" value="delete">

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
    </div>

    <section class="container">
        <h2>Posts by Tag</h2>

        @foreach ($tags as $tag)
            <h3>{{ $tag->name }}</h3>

            @if ($tag->posts->isEmpty())
                <p>No posts for this tag.</p>
            @else
                <ul>
                    @foreach ($tag->posts as $post)
                    <li>
                        <a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </section>
    
@endsection