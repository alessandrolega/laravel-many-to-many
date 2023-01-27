@extends('layouts.dashboard')
@section('content')
<div class="text-center">
    <h1>Modifica il post {{$post->title}}</h1>
</div>

<form action="{{route('admin.posts.update',$post->id)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label"for="">Titolo</label>
        <input value="{{$post->title}}" type="text" class="form-control" name="title">
        @error('title')
            <div class="alert alert-danger">
                {{ $message }}

            </div>
            
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="">Body</label>
        <textarea class="form-control" name="body">{{$post->body}}</textarea>
        @error('body')
            <div class="alert alert-danger">
                {{ $message }}

            </div>
            
        @enderror
    </div>

      {{-- SELECT --}}

      <div class="my-3">
        <label for="">Categories</label>
        <select class="form-control" name="category_id">
            <option value="">Seleziona Categoria</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}"
                 {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
                {{$category->name}}
            </option>  
        @endforeach
        </select>
    </div>

     {{-- CHECKBOX --}}

     <div class="my-3">
        <label  for="">Tags:</label>
        @foreach ($tags as $tag)
        <label class="px-3" for="">
            <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}" {{$post->Tags->contains($tag) ? 
            'checked' : ''}}>
            {{$tag->name}}
        </label>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Modifica Post</button>

{{-- {{dd($post)}} --}}
</form>
    
@endsection