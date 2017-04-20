$(document).ready(function () {

    function validateChangePasswordForm(password1, password2) {

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

    }

    var requestPass;
    var changePasswordForm = $('#changePasswordForm');

    $('#btnPassword').click(function () {

        if ($('.alert')) {
            $('.alert').remove();
        }

        if (requestPass) {
            requestPass.abort();
        }

        var $form = changePasswordForm;
        var password1 = $('#changePassword1').val();
        var password2 = $('#changePassword2').val();

        if (validateChangePasswordForm(password1, password2) === false) {
            event.preventDefault();
        } else {
            if (readCookie('token') !== false) {
                var token = readCookie('token');
            } else {
                event.preventDefault();
            }
            var $inputs = $form.find('input');
            $inputs.prop('disabled', true);

            requestPass = $.ajax({
                url: "api/user.php",
                type: "post",
                dataType: 'json',
                data: {password1: password1, password2: password2, jsSession: token}
            });

            requestPass.done(function (response) {
                console.log(response);
                if (response.type === 'error') {
                    createAlert(response.msg, response.color);
                } else {
                    createAlert(response.msg, response.color);
                    window.setTimeout(function(){
                        window.location.href = "index.php";
                    }, 2000);
                }
                $('.alert').alert();
            });

            requestPass.fail(function () {
                createAlert('Brak połączenia z serwerem PHP', 'warning');
                $('.alert').alert();
            });

            requestPass.always(function () {
                $inputs.prop('disabled', false);
            });
        }
    });

});