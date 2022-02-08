@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ $post->title }}</h1>

        <div class="mb-5">
            {{-- Relative Category --}}
            <span class="mb-3">
                <h5>
                Category:
                @if($post->category) {{$post->category->name}}
                    @else Uncategorized
                @endif
                </h5>
            </span>
            {{-- Action buttons - EDIT, BACK TO ARCHIVE --}}
            <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
            <a class="btn btn-danger" href="{{ route('admin.posts.index', $post->id) }}">Back to archive</a>

        </div>
        {{-- Content --}}
        <div class="row">
            <div class="col-6">
                {!! $post->content !!}
            </div>
            {{-- Image space --}}
            <div class="col-6">
                Here goes image
            </div>
        </div>

        @if(!$post->tags->isEmpty())
            <h4>Tags</h4>

            @foreach ($post->tags as $tag)
                <span class="badge badge-primary">
                    {{ $tag->name }}
                </span>
            @endforeach

        @else
            <p>No tags for this post.</p>
        @endif
        
    </div>
@endsection