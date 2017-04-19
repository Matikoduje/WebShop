<?php
require 'templates/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password1'], $_POST['password2'])) {
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];
    $loadUser = unserialize($_SESSION['user']);
    try {
        $controller = new UserController();
        $repository = new UserRepository();
        $controller->changePassword($repository, $loadUser);
        $msg = new Alert("Udanie zmieniono hasło","success");
        unset($loadUser);
    }
    catch (Exception $e) {
        $msg = new Alert($e->getMessage(), 'danger');
    }
}
?>

    <div class="row" id="forAlert">
        <?php
        if (isset($msg)) {
            echo $msg->getAlert();
        }
        ?>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form class="form-horizontal" method="post" action="#" id="changePasswordForm">
                <fieldset>
                    <legend style="text-align: center">Formularz zmiany hasła</legend>
                    <div class="form-group has-warning">
                        <label for="password1" class="col-lg-4 control-label">Nowe hasło:</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="password1" name="password1">
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="password2" class="col-lg-4 control-label">Powtórz hasło:</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="password2" name="password2">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                            <button type="submit" class="btn btn-primary">Zmień hasło</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
<?php
require 'templates/footer.php';
