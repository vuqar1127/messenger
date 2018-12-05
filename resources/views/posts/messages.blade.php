@extends('welcome')

@section('content')
<link href="/awesome/css/all.css" rel="stylesheet">

<div class="container">
	@if(isset($error))
		<br/> <br/> <h2>{{$error}}</h2> <br/> <br/><br/> <br/><br/> <br/><br/> <br/>
	@else
		<div class="dialogs"> <br/>
			<ul class="list-group">
			@foreach($dialogs as $dialog)
				<a href="/messages/{{$dialog->id}}">
				  	<li class="list-group-item d-flex justify-content-between align-items-center">
				    {{$dialog->name}}
				    <span class="badge badge-primary badge-pill"> {{$status}} </span>
				  	</li>
			  	</a>
			@endforeach
			</ul>
		</div> <br/><br/> <br/><br/> <br/>
	@endif
</div>

@endsection