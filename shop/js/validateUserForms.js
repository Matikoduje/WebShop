$(document).ready(function () {

    function validateRegisterForm(login, email, password1, password2, name, surname) {

        if (login == '' || email == '' || password1 == '' || password2 == '' || name == '' || surname == '') {
            createAlert('Proszę uzupełnić wszystkie dane potrzebne do rejestracji', 'warning');
            $('.alert').alert();
            return false;
        }

        if (login.length < 5 || login.length > 60) {
            createAlert('Login ma nieodpowiednią długość znaków', 'warning');
            $('.alert').alert();
            return false;
        }

        if (name.length < 3 || name.length > 60) {
            createAlert('Imię ma nieodpowiednią długość znaków', 'warning');
            $('.alert').alert();
            return false;
        }

        if (surname.length < 3 || surname.length > 60) {
            createAlert('Nazwisko ma nieodpowiednią długość znaków', 'warning');
            $('.alert').alert();
            return false;
        }

        if (password1.length < 5 || password1.length > 60) {
            createAlert('Podane hasło jest nieodpowiedniej długości', 'warning');
            $('.alert').alert();
            return false;
        }

        if (password1 !== password2) {
            createAlert('Podane hasła są różne', 'warning');
            $('.alert').alert();
            return false;
        }

        var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if (!email.match(mailFormat)) {
            createAlert('Proszę wprowadzić poprawny email', 'warning');
            $('.alert').alert();
            return false;
        }

        if ($('#checkboxAccepted').prop('checked') == false) {
            createAlert('Proszę zapoznać się z regulaminem serwisu i go zaakceptować', 'warning');
            $('.alert').alert();
            return false;
        }
    };

    function validateLoginForm(log, pass) {

        if (log == '' || pass == '') {
            createAlert('Proszę uzupełnić wszystkie dane potrzebne do logowania', 'warning');
            $('.alert').alert();
            return false;
        }
    };

    var request;
    var loginForm = $('#loginForm');
    var registerForm = $('#registerForm');

    $('#registerButton').click(function (event) {

        if ($('.alert')) {
            $('.alert').remove();
        }

        if (request) {
            request.abort();
        }

        var $form = registerForm;
        var login = $('#inputLogin').val();
        var email = $('#inputEmail').val();
        var password1 = $('#inputPassword1').val();
        var password2 = $('#inputPassword2').val();
        var name = $('#inputName').val();
        var surname = $('#inputSurname').val();

        if (validateRegisterForm(login, email, password1, password2, name, surname) === false) {
            event.preventDefault();
        } else {
            var $inputs = $form.find('input');
            var serializedData = $form.serialize();
            $inputs.prop('disabled', true);

            request = $.ajax({
                url: "api/user.php",
                type: "post",
                data: serializedData
            });

            request.done(function (response) {
                var data = $.parseJSON(response);
                if (data.type === 'error') {
                    createAlert(data.msg, data.color);
                } else {
                    createAlert(data.msg, data.color);
                }
                $('.alert').alert();
            });

            request.fail(function () {
                createAlert('Brak połączenia z serwerem PHP', 'warning');
                $('.alert').alert();
            });

            request.always(function () {
                $inputs.prop('disabled', false);
            });
        }

    });

    $('#loginButton').click(function (event) {

        if ($('.alert')) {
            $('.alert').remove();
        }

        if (request) {
            request.abort();
        }

        var $form = loginForm;
        var log = $('#inputLogin2').val();
        var pass = $('#inputPassword').val();

        if (validateLoginForm(log, pass) === false) {
            event.preventDefault();
        } else {
            var $inputs = $form.find('input');
            var serializedData = $form.serialize();
            $inputs.prop('disabled', true);

            request = $.ajax({
                url: "api/user.php",
                type: "post",
                data: serializedData
            });

            request.done(function (response) {
                var data = $.parseJSON(response);
                if (data.type === 'error') {
                    createAlert(data.msg, data.color);
                } else {
                    createCookie('token', data.token, 1);
                    if (typeof readCookie('token') !== false ) {
                        createAlert(data.msg, data.color);
                        window.setTimeout(function(){
                            window.location.href = "index.php";
                        }, 2000);
                    } else {
                        createAlert('Nie udało się nawiązać połączenia z serwerem', 'warning');
                    }
                }
                $('.alert').alert();
            });

            request.fail(function () {
                createAlert('Brak połączenia z serwerem PHP', 'warning');
                $('.alert').alert();
            });

            request.always(function () {
                $inputs.prop('disabled', false);
            });
        }

    })
});