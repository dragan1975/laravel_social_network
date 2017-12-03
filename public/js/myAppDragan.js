$(document).ready(function(){

	$(".leaveGroup").click(function(){
      var r = confirm("Are you sure you want to leave the group.");
      if(r){}
      else{
    	  return false;
      }
    });


  $('.sendMessageButton').click(function(){

    $(this).parent().parent().next().next().removeClass('hide');
    
  });


  $(".cancelSendForm").click(function(){
    $(this).parent().parent().parent().addClass('hide');
  });

  // $(".formMessage").on('submit', function(e){
  //   e.preventDefault();
  //   let body = $(this).find("#body").val();
  //   let user = $(this).find(".member").val();
  //   let sender = $(this).find(".sender").val();

  //   sendMessage(body, user, sender);
  // });

  // function sendMessage(body, user, sender){
  //   $.ajax({
  //     method: 'POST',
  //     url: 'http://localhost:8000/messages/' + user + '/send/' + sender,
  //     data: { body: body },
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     }
  //   }).done(function(){
  //     alert('The message was sent!');
  //     location.reload();
  //   });
  // }

});