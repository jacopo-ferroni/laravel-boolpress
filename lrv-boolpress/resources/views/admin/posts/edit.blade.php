@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Edit {{ $post->title }}</h1>

            {{-- If Errors --}}
            @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            @endif
            {{-- End If Errors --}}

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Title --}}
            <div class="mb-5">
                <label class="form-label" for="title">Title*</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ $post->title }}">
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- Content --}}
            <div class="mb-5">
                <label class="form-label" for="content">Content*</label>
                <textarea class="form-control" type="text" name="content" id="content" rows="6">{{ old('content', $post->content )}}</textarea>
                @error('content')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Categories --}}

            <div class="mb-5">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Uncategorized</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"  @if ($category->id == old('category_id', $post->category_id)) selected @endif>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                {{-- Message Error --}}
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
                    @if($errors->any() && in_array($tag->id, old('tags', []))) 
                    checked
                    @elseif(!$errors->any() && $post->tags->contains($tag->id))
                    checked
                    @endif>

                    <label for="tag{{ $loop->iteration }}">
                        {{ $tag->name }}
                    </label>
                </span>
                @endforeach
                {{-- Tag Error --}}
                @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            {{-- image --}}
            <div class="mb-3">
                <label for="cover" class="form-label">Post Image:</label>
                @if ($post->cover)
                    <img width="200" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->cover}}">
                @endif
                
                <input type="file" class="from-control-file" name="cover" id="cover">
            </div>

            {{-- Submit --}}
            <button class="btn btn-primary" type="submit">Update Post</button>

        </form>
    </div>
@endsection