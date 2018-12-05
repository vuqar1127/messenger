@extends('welcome')

@section('content')

<div class="container">
	<link href="/awesome/css/all.css" rel="stylesheet">

	<div class="dialogs" style="width: 38%; float: right; ">
		<li>hkjm</li>
		<li>jkm</li>
		<li>kjm</li>
		<li>hbkjnl</li>
	</div>
	<div class="messagesPlace" style="width: 60%;">
		@if(isset($error))
			<div class="alert alert-danger">
			  <strong>Stop!</strong> Bu dialog mövcud deyil və ya sizə məxsus deyil!
			</div>
		@else
			<div class="messages" id="messagesDiv"> 
			@foreach($messages as $message)
				@if($message->usid === Auth::user()->id )
					<li style="text-align: right; list-style: none;"> <a href="#" class="btn btn-primary my-2"> {{$message->message}} 
					@if($message->status === 1)
						<i class="fas fa-check-double"></i>
					@elseif($message->status === 0)
						<i class="fas fa-check"></i>
					@endif
					</a> </li>
					
				@else
					<li style="text-align: left; list-style: none;"> <a href="#" class="btn btn-secondary my-2"> {{$message->message}} </a> </li>
				@endif
			@endforeach
			</div>
		<!-- /messages/{{ Request::segment(2) }} -->
			<form action="#">	
			{{ csrf_field() }}	
				<textarea class="form-control" rows="5" id="message" name="message"></textarea>
				<button type="submit" id="send" class="btn btn-primary btn-lg btn-block">Gonder</button>
			</form>
		@endif
	</div>
</div>

	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});


		$(document).ready(function(){
	
					$('#send').click(function(){

						var message = $('#message').val();
						var url = location.href;
						var id = url.split('/').reverse()[0];
						//alert(id);

						$.ajax({
							type: "GET",
							url: "/sendNewMessage",
							data: {message:message, id:id},
							dataType: 'json',
							success: function(data){
								 //var obj = $.parseJSON(data);
								 //alert(data.message);
								 console.log(data);
								var row = $('<li style="text-align: right; list-style: none;"> <a href="#" class="btn btn-primary my-2">' + data.message + ' <i class="fas fa-check"></i> </a> </li>');
								$('#messagesDiv').append(row);
								$('#message').val('');
							}
						});
						return false
					});


					setInterval(function() {

						var url = location.href;
						var id = url.split('/').reverse()[0];

					    $.ajax({
							type: "GET",
							url: "/NewMessage",
							data: {id:id},
							dataType: 'json',
							success: function(data){
								//alert(data.messages);
								if (data.messages == 'false') {
								}
								else {
									//var obj = $.parseJSON(data);
									//alert(data.message);

									console.log(data);
									var row = $('<li style="text-align: left; list-style: none;"> <a href="#" class="btn btn-secondary my-2">' + data.messages + ' </a> </li>');
									$('#messagesDiv').append(row);
								}

							}
						});

					},3000);

						
		});
</script>

@endsection