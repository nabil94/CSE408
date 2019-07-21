@extends('layouts.app')

@section('content')
<div class row>
   <div class="col-md-6">
      <h1>Notifications</h1>
   </div>
<h1>{{count($posts)}}</h1>
</div>
   <table class="table table-bordered">
   	<thead>
   		<tr>
   			<th>No</th>
   			<th>News</th>
   		</tr>
   	</thead>
   	<tbody>
   		@foreach($posts as $post)
         @if($post->status == 'confirm')
   		   <tr>
   			     <td>{{$post->id}}</td>
   			       <td>{{$post->user_name}} has accepted your request. He takes {{$post->room_name}}</td>
          @endif
          @if($post->status == 'cancel')
          <tr>
              <td>{{$post->id}}</td>
                <td>{{$post->user_name}} has denied your request</td>
           @endif

   		@endforeach

   	</tbody>
   </table>
@endsection
