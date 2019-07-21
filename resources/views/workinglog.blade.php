@extends('layouts.app')

@section('content')
<div class row>
   <div class="col-md-6">
      <h1>Working Logs</h1>
   </div>
<h1>{{count($posts)}}</h1>
<h1>{{count($psts)}}</h1>
</div>
   <table class="table table-bordered">
   	<thead>
   		<tr>
   			<th>No</th>
   			<th>Log</th>
   		</tr>
   	</thead>
   	<tbody>
      @foreach($psts as $pst)
   		   <tr>
   			     <td>{{$pst->id}}</td>
   			       <td>You have created {{$pst->title}} at {{$pst->created_at}}</td>
   		@endforeach
      @foreach($pp as $pp1)
        @if($pp1->booking == 'booked')
   		   <tr>
   			     <td>{{$pp1->id}}</td>
   			       <td>You have booked {{$pp1->title}} from {{$pp1->requested_from_date}} to {{$pp1->requested_to_date}}</td>
        @endif
    	@endforeach
   		@foreach($posts as $post)
         @if($post->status == 'confirm')
   		   <tr>
   			     <td>{{$post->id}}</td>
   			       <td>You have accepted {{$post->guest_name}}'s request</td>
          @endif
          @if($post->status == 'cancel')
          <tr>
              <td>{{$post->id}}</td>
                <td>You have denied {{$post->guest_name}}'s request</td>
           @endif

   		@endforeach

   	</tbody>
   </table>
@endsection
