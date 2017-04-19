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

function eraseCookie(name) {
    createCookie(name, "", -1);
}

$(document).ready(function () {

    function menuLogged() {
        var menu = $('#menuList');
        var caret = $('#colorCaret');
        var color = $('#colorMenu');
        caret.removeClass();
        color.removeClass();
        menu.empty();
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
        var caret = $('#colorCaret');
        var color = $('#colorMenu');
        caret.removeClass();
        color.removeClass();
        caret.addClass('caret text-warning');
        color.addClass('text-warning');
        menu.empty();
        menu.append('<li class="navbar-inverse"><a href="login.php"><span class="text-warning">Zaloguj/Zarejestruj</span></a></li>');
    }

    var request;
    if (readCookie('token') !== false) {
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