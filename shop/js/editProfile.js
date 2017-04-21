$(document).ready(function () {

    function requestFromDatabase() {

        var requestGet;

        if (readCookie('token') !== false) {
            var token = readCookie('token');
        } else {
            return;
        }

        requestGet = $.ajax({
            url: "api/user.php",
            type: "post",
            dataType: 'json',
            data: {jsSession: token}
        });

        requestGet.done(function (response) {
            console.log(response.codeC);
            if (response.type === 'success') {
                $('#email').val(response.email);
                $('#name').val(response.name);
                $('#surname').val(response.surname);
                $('#street').val(response.street);
                $('#city').val(response.city);
                $('#numberS').val(response.number);
                $('#codeC').val(response.codeC);
            } else {
                createAlert('Przepraszamy ale mamy problem na serwerze', 'warning');
                $('.alert').alert();
            }
        });

        requestGet.fail(function () {
            createAlert('Brak połączenia z serwerem PHP', 'warning');
            $('.alert').alert();
        });
    }

    function validateEditProfileForm(email, name, surname, street, city, number, code) {

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

        var mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if (!email.match(mailFormat)) {
            createAlert('Proszę wprowadzić poprawny email', 'warning');
            $('.alert').alert();
            return false;
        }

        if ((street.length < 3 || street.length > 255) && street !== '') {
            createAlert('Proszę wprowadzić poprawną nazwę ulicy', 'warning');
            $('.alert').alert();
            return false;
        }

        if ((city.length < 3 || city.length > 60) && city !== '') {
            createAlert('Proszę wprowadzić poprawną nazwę miasta', 'warning');
            $('.alert').alert();
            return false;
        }

        var codeFormat = /^\d\d-\d\d\d$/;

        if (!code.match(codeFormat) && code !== '') {
            createAlert('Proszę wprowadzić poprawny kod pocztowy', 'warning');
            $('.alert').alert();
            return false;
        }

        if (number.length > 10) {
            createAlert('Proszę wprowadzić poprawny numer domu/mieszkania', 'warning');
            $('.alert').alert();
            return false;
        }
    }

    requestFromDatabase();
    var requestEdit;
    var editProfileForm = $('#editProfileForm');


    $('#btnEdit').click(function () {

        if ($('.alert')) {
            $('.alert').remove();
        }

        if (requestEdit) {
            requestEdit.abort();
        }

        var $form = editProfileForm;
        var email = $('#email').val();
        var name = $('#name').val();
        var surname = $('#surname').val();
        var street = $('#street').val();
        var city = $('#city').val();
        var number = $('#numberS').val();
        var code = $('#codeC').val();

        if (validateEditProfileForm(email, name, surname, street, city, number, code) === false) {
            event.preventDefault();
        } else {
            if (readCookie('token') !== false) {
                var token = readCookie('token');
            } else {
                event.preventDefault();
            }
            var $inputs = $form.find('input');
            $inputs.prop('disabled', true);

            requestEdit = $.ajax({
                url: "api/user.php",
                type: "post",
                dataType: 'json',
                data: {email: email, name: name, surname: surname, code: code, city: city, street: street, number: number, jsSession: token}
            });

            requestEdit.done(function (response) {
                if (response.type === 'error') {
                    createAlert(response.msg, response.color);
                } else {
                    createAlert(response.msg, response.color);
                    window.setTimeout(function(){
                        window.location.href = "editprofile.php";
                    }, 2000);
                }
                $('.alert').alert();
            });

            requestEdit.fail(function () {
                createAlert('Brak połączenia z serwerem PHP', 'warning');
                $('.alert').alert();
            });

            requestEdit.always(function () {
                $inputs.prop('disabled', false);
            });
        }

    });
});