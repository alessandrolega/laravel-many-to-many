@extends('layouts.dashboard')
@section('content')


<div class="mb-4">
    <button class="btn btn-success"><a href="{{route('admin.posts.create')}}">Crea Nuovo Post</a></button>
</div>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#id</th>
        <th scope="col">Title</th>
        <th scope="col">Body</th>
        <th scope="col">Category_id</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($posts as $post)

      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->body}}</td>
        <td>
          @if ($post->Category)
            {{$post->Category['name']}}
          @endif
        </td>
        <td>
            <a href="{{route('admin.posts.show', $post->id)}}">
                <i class="fa-solid fa-eye"></i>
            </a>
        </td>
        <td>
            <a href="{{route('admin.posts.edit', $post->id)}}">
                <i class="fa-solid fa-pen"></i>
            </a>
        </td>
        <td>
            <form action="{{route('admin.posts.destroy',$post->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i>Delete</button>
            
            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


    <div>
        {{$posts->links()}}
    </div>

    
@endsection