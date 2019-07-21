@extends('layouts.app')
@section('content')
<div class="card" style="width:350px">
	<div class="card-body">
    <p class="card-text">Host Profile :</p>
    <p class="card-text">ID   : {{$post->id}}</p>
    <p class="card-text">Name : {{$post->name}}</p>
    <p class="card-text">Email:{{$post->email}}</p>
    <p class="card-text">no   :{{$post->phone_number}}</p>
    <p class="card-text">age  :{{$post->age}}</p>
    <p class="card-text">nid  :{{$post->nid}}</p>



			<div class="col-md-4">
				<a href="{{action('PostsController@index')}}" class="btn btn-primary">Back</a>
			</div>
		</div>
</div>
@endsection
