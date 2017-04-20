<?php
require 'templates/header.php';

?>
    <script src="js/changePassword.js?a=32"></script>
    <div class="row" id="forAlert">
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form class="form-horizontal" id="changePasswordForm">
                <fieldset>
                    <legend style="text-align: center">Formularz zmiany hasła</legend>
                    <div class="form-group has-warning">
                        <label for="password1" class="col-lg-4 control-label">Nowe hasło:</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="changePassword1" name="changePassword1">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="password2" class="col-lg-4 control-label">Powtórz hasło:</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="changePassword2" name="changePassword2">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                            <button type="button" id="btnPassword" class="btn btn-primary">Zmień hasło</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
<?php
require 'templates/footer.php';
