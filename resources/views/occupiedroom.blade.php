@extends('layouts.app')
 $items = array();
 $names = array();
@section('content')
<div class="container">

    <div class="row justify-content-center">
        @if(count($posts)<1)
           <h1>No Room in Use</h1>
        @else

          @foreach($posts as $post)
        <div class="col-md-6">
           <div class="card" style="width:350px">
            <div class="card-body">
        <div class="card-title">{{$post->title}}</div>
        <p class="card-text">{{$post->location}}</p>
         <p class="card-text">{{$post->hostname}}</p>
         <p class="card-text">{{$post->requested_from_date}}</p>
         <p class="card-text">{{$post->requested_to_date}}</p>


    </div>
</div>
</br>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
