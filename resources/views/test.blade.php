<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />

</head>
<body>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<div class="row col-lg-5">
		<h2> Get Request </h2>
		<button id="getRequest">getRequest</button>


	<div id="getRequestData"></div>
	</div>


	<div class="row col-lg-5">
		<h2>Register Form</h2>
		<form id="register" action="#">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="message"></label>
			<input type="text" name="message" id="message" class="form-control">
			<input type="submit" value="Register" class="btn btn-pramary">
		</form>

	<div id="postRequestData"></div>
	</div>

<style type="text/css">
	td {margin-top: 20px;}
</style>
	<div id="users" class="row col-lg-12">
		<table id="table" border="1">
		</table>
	</div>

	<!-- AJAX -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});


		$(document).ready(function(){

			$.ajax({
					type: "GET",
					url: "/getUser",
					data: {id:1},
					dataType: 'json',
					success: function(data){
						//$('#postRequestData').append(data);
						console.log(data);

						$('#table').empty();
						//alert(data[1].message);
						$.each(data.messages, function(i, message){
							//alert(message.message);
							var row = $('<tr/>');
							row.append($('<td/>', { text : message.message }))

						$('#table').append(row);
						});
					}
				});


			// $('#getRequest').click(function(){
			// 	//alert($(this).text());
			// 	$.get('getRequest', function(data){
			// 		$('#getRequestData').append(data);
			// 		console.log(data);
			// 	});
			// });


			// $('#register').submit(function(){
			// 	var message = $('#message').val();

			// 	// $.post('postForm', {message:message }, function(data){
			// 	// 	$('#postRequestData').html(data);
			// 	// 	console.log(data);
			// 	// });

			// 	var dataString = "message="+message;
			// 	$.ajax({
			// 		type: "POST",
			// 		url: "postForm",
			// 		data: dataString,
			// 		success: function(data){
			// 			$('#postRequestData').append(data);
			// 			console.log(data);
			// 		}
			// 	});
			// 	$('#message').val('');
			// 	return false;
			// });

});

	</script>
</body>
</html>