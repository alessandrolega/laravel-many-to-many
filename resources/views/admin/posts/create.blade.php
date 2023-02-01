@extends('layouts.dashboard')
@section('content')
<div class="text-center">
    <h1>Crea un nuovo Post</h1>
</div>

<form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label"for="">Titolo</label>
        <input type="text" class="form-control" name="title">
        @error('title')
            <div class="alert alert-danger">
                {{ $message }}

            </div>
            
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="">Body</label>
        <textarea class="form-control" name="body"></textarea>
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
            <option value="{{$category->id}}">
                {{$category->name}}
            </option>
            
        @endforeach
        </select>
    </div>

    {{-- CHECKBOX --}}

    <div class="my-3">
        <label for="">Tags:</label>
        @foreach ($tags as $tag)
        <label for="">
            <input type="checkbox" name="tags[]" value="{{$tag->id}}">
            {{$tag->name}}
        </label>
        @endforeach
    </div>

    {{-- INPUT FILE --}}
    <div class="my-3">
        <label for="">Aggiunta cover image</label>
        <input type="file" name="image" class="form-control-file">

    </div>

    <button type="submit" class="btn btn-primary">Crea Nuovo Post</button>


</form>
    
@endsection