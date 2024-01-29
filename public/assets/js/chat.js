$(document).ready(function () {
	$(document).ready(function() {
		var receiverid;
		var message;
		var senderid = $('#senderid').html();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).on("click", ".receiverid", function() {
			receiverid = $(this).attr('id');
			console.log(receiverid);
			console.log("clicked");
			getmessages(message = "", senderid, receiverid);
		});
	
		$('#chatbtn').click(function() {
			message = $('#message').val();
			console.log(message,senderid,receiverid);
			getmessages(message, senderid, receiverid);
		});
		// setInterval(() => {
		//     $("#messages-list").load(location.href + " #messages-list");
		// }, 10000);
		// setInterval(() => {
		//     getmessages(message = "", senderid, receiverid);
		// }, 10500);
	
		function getmessages(message, senderid, receiverid) {
			$.ajax({
				url: "{{route('syndash.chat')}}",
				method: "POST",
				data: {
					message: message,
					senderid: senderid,
					receiverid: receiverid
				},
				success: function(response) {
					$('#messages-list').empty();
					$("#chatform")[0].reset();
					var sender = response.sdata.length;
					var receiver = response.rdata.length;
					var lngth = Math.max(sender, receiver); 
					for (var i = 0; i < lngth; i++) {
						if (response.rdata[i] != undefined) {
							$('#messages-list').append(
								'<p class="chat-left-msg" >' + response.rdata[i].message + '</p>'
							);
						} 
						if (response.sdata[i] != undefined) {
							$('#messages-list').append(
								'<p class="chat-right-msg">' + response.sdata[i].message + '</p>'
							);
						} 
						$("#chatform")[0].reset();
					   
					}
					
				}
			});
		}
	})
});

