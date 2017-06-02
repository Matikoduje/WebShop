<?php
require 'templates/header.php';
?>
    <script src="js/validateUserForms.js?a=2"></script>
    <div class="row" id="forAlert">
    </div>
    <div class="row">
        <div class="col-sm-5">
            <form class="form-horizontal" id="loginForm">
                <fieldset>
                    <legend style="text-align: center">Mam już konto - logowanie</legend>
                    <div class="form-group has-warning">
                        <label for="inputLogin2" class="col-lg-4 control-label">Login:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="inputLogin2" name="loginLogin">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputPassword" class="col-lg-4 control-label">Hasło:</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="inputPassword" name="loginPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                            <button type="button" class="btn btn-primary" id="loginButton">Zaloguj</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                            <a href="#">Przypomnij mi hasło</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <form class="form-horizontal" id="registerForm">
                <fieldset>
                    <legend style="text-align: center">Jestem nowym klientem - rejestracja</legend>
                    <div class="form-group has-warning">
                        <label for="inputLogin" class="col-lg-4 control-label">Login:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="inputLogin" name="login">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputEmail" class="col-lg-4 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input type="email" class="form-control" id="inputEmail" name="email">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputName" class="col-lg-4 control-label">Imię:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="inputName" name="name">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputSurname" class="col-lg-4 control-label">Nazwisko:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="inputSurname" name="surname">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputPassword1" class="col-lg-4 control-label">Hasło:</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="inputPassword1" name="password1">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="inputPassword2" class="col-lg-4 control-label">Powtórz hasło:</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="inputPassword2" name="password2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="isAccepted" value="true" id="checkboxAccepted"> Zapoznałem się
                            z regulaminem serwisu i akceptuję jego treść
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                            <button type="button" class="btn btn-primary" id="registerButton">Zarejestruj</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
<?php
require 'templates/footer.php';
?>