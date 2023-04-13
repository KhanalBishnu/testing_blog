$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function (e) {
    // $('chat-container').html('');
  
    $('.user_list').click(function (e) {
        e.preventDefault();
       
    
        $('#'+receiver_id+'-select_status').removeClass('user-select');
        $('#chat-container').html('');
        var getUserId = $(this).attr('data-id')
        receiver_id = getUserId;

        $('.start-head').hide();
        $('.user_profile').hide();
        $('.chat-section').show();
       
        // for old message show 
         loadOldChat();
         $('#'+receiver_id+'-select_status').addClass('user-select');
        // scroll auto make 
         $('#chat-container').get(0).scrollIntoView({behavior: 'smooth'});
    });

    $('#chat-form').submit(function (e) {
        e.preventDefault();
        var message = $('#message').val();
        // alert(message);
        $.ajax({
            type: "POST",
            url: "/home",
            data: { sender_id: sender_id, receiver_id: receiver_id, message: message },
            success: function (res) {
                // alert(response);
                $('#message').val('');
                let chat = res.data.message;
                let html = `
                     <div class="chat-color" id="chat-sender">
                        <h4>`+ chat + `</h4>
                     </div>
                `;
                $('#chat-container').append(html);
                ScrollChat()

            }
        });



    });


    
   
  
});
function loadOldChat() {
    $.ajax({
        type: "POST",
        url: "/load-chat",
        data: { sender_id: sender_id, receiver_id: receiver_id },
        success: function (res) {
            if (res.success) {
                // console.log(res.user);
                // let user_name= res.user.name
                let user_name=`
                <p>`+res.user.name+`</p>
                `;
                $('#chat-container').append(user_name);

                let chats = res.data;
                let html = '';
                for (let i = 0; i < chats.length; i++) {
                    let addClass = '';
                    if (chats[i].sender_id == sender_id) {
                        addClass = 'chat-sender';
                    } else {
                        addClass = 'chat-receiver';
                    }
                    html += `

                        <div class="chat-color" id="`+ addClass + `">
                        <h4>`+chats[i].message+`</h4>
                        </div>
                        `;
                    $('#chat-container').append(html);
                    ScrollChat()
                }
            } else {
                alert(res.message);
            }
        }


    });
      // <p>`+user.name+`</p>
}

function ScrollChat(){
    $('#chat-container').animate({
        scrollTop:$('#chat-container').offset().top + $('#chat-container')[0].scrollHeight
    },0);
}
Echo.join('user-status').here((users) => {
    // console.log(users);
    for (let x = 0; x < users.length; x++) {
        if (sender_id != users[x]['id']) {
            $('#' + users[x]['id'] + '-status').removeClass('offline-status');
            $('#' + users[x]['id'] + '-status').addClass('online-status');
            $('#' + users[x]['id'] + '-status').text('Online');
        }

    }

})
    .joining((user) => {
        $('#' + user.id + '-status').removeClass('offline-status');
        $('#' + user.id + '-status').addClass('online-status');
        $('#' + user.id + '-status').text('Online');
        //    console.log(user+'hyy');
    })

    .leaving((user) => {
        //    console.log(user+'by');
        $('#' + user.id + '-status').removeClass('online-status');
        $('#' + user.id + '-status').addClass('offline-status');
        $('#' + user.id + '-status').text('Offline');
    })

    .listen('UserStatusEvent', (e) => {

    });

//    broadcast message data 
Echo.private('chat-data').listen('.getChatMessage', (data) => {
    // alert(data);
    if (sender_id == data.chat.receiver_id && receiver_id == data.chat.sender_id) {
        let html = `
        <div class="chat-color" id="chat-receiver">
         <h4>`+ data.chat.message + `</h4>
         </div>
        `;
        $('#chat-container').append(html);

    }
});