<?php
require 'templates/header.php';

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//    if (isset($_POST['loginLogin'], $_POST['loginPassword'])) {
//
//        $login = $_POST['loginLogin'];
//        $pass = $_POST['loginPassword'];
//
//        try {
//            $controller = new UserController();
//            $repository = new UserRepository();
//            $loadUser = $controller->load($repository, $login, $pass);
//            $_SESSION['user'] = serialize($loadUser);
//            unset($controller, $repository, $loadUser);
//            header('Location: index.php');
//            exit;
//        } catch (Exception $e) {
//            $msg = new Alert($e->getMessage(), 'danger');
//        }
//
//    } else if (isset($_POST['login'], $_POST['email'], $_POST['password1'], $_POST['name'], $_POST['surname'], $_POST['password2'], $_POST['isAccepted'])) {
//
//        $isAccepted = $_POST['isAccepted'];
//        if ($isAccepted == true) {
//            try {
//                $controller = new UserController();
//                $repository = new UserRepository();
//                $controller->save($repository);
//                $msg = new Alert("Rejestracja przebiegła pomyślnie. Zapraszamy do logowania", "success");
//                unset($controller, $repository);
//            } catch (Exception $e) {
//                $msg = new Alert($e->getMessage(), 'danger');
//            }
//        } else {
//            $msg = new Alert("Proszę zapoznać się z warunkami korzystania z serwisu", "info");
//        }
//    }
}
?>
    <script src="js/validateUserForms.js?a=2"></script>
    <div class="row" id="forAlert">
        <?php
        if (isset($msg)) {
            echo $msg->getAlert();
        }
        ?>
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