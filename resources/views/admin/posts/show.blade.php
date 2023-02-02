@extends('layouts.dashboard')
@section('content')
<div class="text-center">
    <h1>{{$singolo_post->title}}</h1>
    <img src="{{asset("storage/$singolo_post->cover")}}" alt=""> 
    <p>{{$singolo_post->body}}</p>

</div>
    
@endsection