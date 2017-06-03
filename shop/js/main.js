function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return false;
}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    } else {
        var expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function createAlert(message, alertType) {
    $('#forAlert').append('<div class="alert alert-' + alertType + ' fade in"><a class="close" data-dismiss="alert">×</a><span>' + message + '</span></div>')
};

$(document).ready(function () {

    function menuLogged() {
        var menu = $('#menuList');
        var basket = $('#basket');
        var caret = $('#colorCaret');
        var color = $('#colorMenu');
        caret.removeClass();
        color.removeClass();
        menu.empty();
        basket.empty();
        basket.append('<a href="basket.php"><span class="text-primary">Mój koszyk</span></a>');
        menu.append('<li class="navbar-inverse"><a href="editprofile.php"><span class="text-primary">Moje dane</span></a></li>');
        menu.append('<li class="navbar-inverse"><a href="#"><span class="text-primary">Moje zakupy</span></a></li>');
        menu.append('<li class="navbar-inverse"><a href="message.php"><span class="text-primary">Wiadomości</span></a></li>');
        menu.append('<li class="divider text-warning"></li>');
        menu.append('<li class="navbar-inverse"><a href="changepassword.php"><span class="text-warning">Zmień hasło</span></a></li>');
        menu.append('<li class="navbar-inverse"><a href="" id="logout"><span class="text-warning">Wyloguj się</span></a></li>');
        caret.addClass('caret text-primary');
        color.addClass('text-primary');
    }

    function menuNotLogged() {
        var menu = $('#menuList');
        var basket = $('#basket');
        var caret = $('#colorCaret');
        var color = $('#colorMenu');
        caret.removeClass();
        color.removeClass();
        caret.addClass('caret text-warning');
        color.addClass('text-warning');
        menu.empty();
        basket.empty();
        menu.append('<li class="navbar-inverse"><a href="login.php"><span class="text-warning">Zaloguj/Zarejestruj</span></a></li>');
    }

    var request;
    if (typeof readCookie('token') !== false) {
        var token = readCookie('token');
        request = $.ajax({
            url: "api/checkSession.php",
            type: "post",
            dataType: 'json',
            data: {jsSession: token}
        });

        request.done(function (response) {
            if (response.type === 'success') {
                menuLogged();
            } else {
                menuNotLogged();
            }
        });

        request.fail(function () {
            menuNotLogged();
        });
    } else {
        menuNotLogged();
    }

    $('body').on('click', '#logout', function () {
        var logoutRequest;
        logoutRequest = $.ajax({
            url: "api/logout.php",
            type: "post",
            dataType: 'json'
        });

        logoutRequest.done(function (response) {
            if (response.type === 'success') {
                eraseCookie('token');
                window.setTimeout(function(){
                    window.location.href = "index.php";
                }, 50);
            } else {
                window.setTimeout(function(){
                    window.location.href = "index.php";
                }, 50);
            }
        });

        logoutRequest.fail(function () {
            window.setTimeout(function(){
                window.location.href = "index.php";
            }, 50);
        });
    });
});