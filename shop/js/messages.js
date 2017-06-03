$(document).ready(function () {

    function getMessagesData(token) {
        var requestMessages;

        requestMessages = $.ajax({
            url: "api/messages.php",
            type: "post",
            dataType: "json",
            data: {jsSession: token}
        });

        requestMessages.done(function (response) {
            var messagesTable = $('#messages > tbody');
            $.each(response.messages, function (index, value) {
                var tr = $('<tr>').addClass('messageTr');
                // var iconsTd = $('<td>');
                // iconsTd.append('<a class="btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>');
                var TitleTd = $('<td>');
                var MessageTd = $('<td>');
                var DateTd = $('<td>');
                var idTd = $('<td>');
                if (value.isRead === 0) {
                    TitleTd.addClass('text-danger');
                    MessageTd.addClass('text-danger');
                    DateTd.addClass('text-danger');
                }
                TitleTd.text(value.messageTitle);
                if (value.messageText.length >= 30) {
                    var shortMessageText = value.messageText.slice(0, 28) + '...';
                    MessageTd.text(shortMessageText);
                } else {
                    MessageTd.text(value.messageText);
                }
                DateTd.text(value.messageDate);
                idTd.attr('id', value.id);
                idTd.addClass("hidden-xs hidden");
                tr.append(TitleTd, MessageTd, DateTd, idTd);
                messagesTable.append(tr);
            });
        });
    }

    if (readCookie('token') !== false) {
        var token = readCookie('token');
        getMessagesData(token);
    } else {
        return;
    }

    $('body').on('click', '.messageTr', function (e) {
        console.log($(this));
    });
});