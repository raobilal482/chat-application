<!--start overlay-->
<div class="overlay toggle-btn-mobile"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<!--footer -->
<div class="footer">
    <p class="mb-0">Syndash @2020 | Developed By : <a href="https://themeforest.net/user/codervent" target="_blank">codervent</a>
    </p>
</div>
<!-- end footer -->
</div>
<!-- end wrapper -->
<!--start switcher-->
<div class="switcher-body">
<button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bx bx-cog bx-spin"></i></button>
<div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <h6 class="mb-0">Theme Variation</h6>
    <hr>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="lightmode" value="option1" checked>
      <label class="form-check-label" for="lightmode">Light</label>
    </div>
    <hr>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="darkmode" value="option2">
      <label class="form-check-label" for="darkmode">Dark</label>
    </div>
    <hr>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="darksidebar" value="option3">
        <label class="form-check-label" for="darksidebar">Semi Dark</label>
      </div>
      <hr>
     <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ColorLessIcons" value="option3">
        <label class="form-check-label" for="ColorLessIcons">Color Less Icons</label>
      </div>
  </div>
</div>
</div>
<!--end switcher-->
<!-- JavaScript -->
<!-- Bootstrap JS -->
<script src="{{asset('assets')}}/js/bootstrap.bundle.min.js"></script>

<!--plugins-->
<script src="{{asset('assets')}}/js/jquery.min.js"></script>
<script src="{{asset('assets')}}/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('assets')}}/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{asset('assets')}}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script>
new PerfectScrollbar('.chat-list');
new PerfectScrollbar('.chat-content');
</script>
<!-- App JS -->
<script src="{{asset('assets')}}/js/app.js"></script>


<script>
 $(document).ready(function() {
    var receiverid;
    var message;
    var senderid = $('#senderid').html();
    var receivername;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on("click", ".receiverid", function() {
        $('#onlinetoast').show();
        $('#messages-list').empty();
        $("#chatform")[0].reset();
        receiverid = $(this).attr('id');
        getmessages(message = "", senderid, receiverid);
        var data = @json($users);
        for (i = 0; i < data.length; i++) {
            if (data[i].id == receiverid) {
                receivername = data[i].name.charAt(0).toUpperCase() + data[i].name.slice(1);;
                $('#receivername').html(receivername);
            }
        }
       
    });

    $('#chatbtn').click(function() {
        message = $('#message').val();
        getmessages(message, senderid, receiverid);
     
    });
    setInterval(() => {
		getmessages(message = "", senderid, receiverid);
        $("#messages-list").load(location.href + " #messages-list");
    }, 10000);
	setInterval(() => {
		getmessages(message = "", senderid, receiverid);
    }, 10100);
   
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
                for (var i = 0; i < response.data.length; i++) {
                    const formattedDate = formatTimestamp(response.data[i].created_at);
                    if (response.data[i].sender_id == senderid && response.data[i].receiver_id == receiverid) {
                        $('#messages-list').append(
                            '<div class="chat-content-rightside" id="sender_messages-list" ><div class="d-flex ms-auto"><div class="flex-grow-1 me-2"><p class="mb-0 chat-time text-end"> ' + formattedDate + '</p><p class="chat-right-msg">' + response.data[i].message + '</p></div></div></div>'
                        );
                    }
                    if (response.data[i].sender_id == receiverid && response.data[i].receiver_id == senderid) {
                        $('#messages-list').append(
                            '<div class="chat-content-leftside" id="receiver_messages-list"><div class="d-flex ms-auto"><div class="flex-grow-1 me-2"><p class="mb-0 chat-time text-start"> ' + formattedDate + '</p><p class="chat-left-msg">' + response.data[i].message + '</p></div></div></div>'
                        );
                    }
					 $('#messages-list').scrollTop($('#messages-list')[0].scrollHeight);
                     var height =$('#messages-list')[0].scrollHeight;
                    console.log(height);
                    $("#chatform")[0].reset();
                }
            }
        })
    }
   function formatTimestamp(timestamp) {
    var date = new Date(timestamp);
    var hours = date.getHours();
    var minutes = date.getMinutes();
    if (hours > 12) {
        hours -= 12;
    } else if (hours === 0) {
        hours = 12;
    }
    return hours + ':'+ minutes ;
    
}
})
</script>
</body>
</html>
