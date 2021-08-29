const chatMessages = $('.direct-chat-messages');
const userId = $('#id').val();

$(function () {
    loadMessages();
    listenSendMessage();

    socket.emit('join', {roomId: roomId, authToken: authToken});

    socket.on('chat', function (res) {
        appendMessage(res)
    });
})

function loadMessages()
{
    $.ajax({
        type: 'GET',
        url: '/messages?user_id=' + userId,
        dataType: 'json',
        success: function (response) {
            $.each(response, function(i, message) {
                appendMessage(message);
            });
        }
    })
}

function listenSendMessage()
{
    $('#chat-form').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serializeArray(),
            dataType: 'json',
            encode: true,
            success: function (response) {
                if (typeof response.id !== "undefined") {
                    $('#message').val('');
                }
            }
        }).fail(function( jqXHR, textStatus ) { console.log( "Request failed: " + textStatus ); });
    });
}

function appendMessage(message)
{
    let right = userId == message.receiver_id ? 'right' : '';
    chatMessages.append(`
        <div class="direct-chat-msg ${right}">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">
                    ${message.name}
                </span>
                <span class="direct-chat-timestamp float-right">${message.date}</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="/img/avatar.png" alt="User Image">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                ${message.message}
            </div>
            <!-- /.direct-chat-text -->
        </div>
    `);

    scrollToBottom();
}

function scrollToBottom()
{
    chatMessages.animate({
        scrollTop: chatMessages.prop("scrollHeight")
    }, 1000);
}
