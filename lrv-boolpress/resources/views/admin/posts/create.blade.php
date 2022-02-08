@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Create a new post</h1>

        @if ($errors->any())

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf

            {{-- Title --}}
            <div class="mb-5">
                <label class="form-label" for="title">Title*</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Content --}}
            <div class="mb-5">
                <label class="form-label" for="content">Content*</label>
                <textarea class="form-control" type="text" name="content" id="content" rows="6">{{ old('content') }}</textarea>
                @error('content')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-5">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Uncategorized</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"  @if ($category->id == old('category_id')) selected @endif>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
            </div>

            {{-- Tags --}}
            <div class="mb-3">
                <h4>Tags</h4>

                @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}"
                        @if(in_array($tag->id, old('tags', []))) checked @endif>
                        
                        <label for="tag{{ $loop->iteration }}">
                            {{ $tag->name }}
                        </label>

                    </span>
                @endforeach
                @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <button class="btn btn-primary" type="submit">Create Post</button>

        </form>
    </div>
@endsection