<?php
require 'templates/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
$loadUser = unserialize($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['name'], $_POST['surname'])) {
    try {
        $controller = new UserController();
        $repository = new UserRepository();
        $controller->update($repository, $loadUser);
        $_SESSION['user'] = serialize($loadUser);
        $msg = new Alert("Edycja danych przebiegła pomyślnie","success");
    } catch (Exception $e) {
        $msg = new Alert($e->getMessage(),'danger');
    }
} else if (!isset($_POST['email'], $_POST['name'], $_POST['surname']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = new Alert("Edycja danych przebiegła pomyślnie","success");
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
        <div class="col-sm-4 col-sm-offset-4">
            <form class="form-horizontal" method="post" action="#" id="editProfileForm">
                <fieldset>
                    <legend style="text-align: center">Edycja danych z konta</legend>
                    <div class="form-group has-warning">
                        <label for="email" class="col-lg-4 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="email" name="email"
                                   value=<?php echo $loadUser->getUserEmail() ?>>
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="name" class="col-lg-4 control-label">Imię:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="name" name="name"
                                   value=<?php echo $loadUser->getUserFirstName() ?>>
                        </div>
                    </div>
                    <div class="form-group has-warning">
                        <label for="surname" class="col-lg-4 control-label">Nazwisko:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="surname" name="surname"
                                   value=<?php echo $loadUser->getUserLastName() ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="street" class="col-lg-4 control-label">Ulica:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="street" name="street"
                                   value=<?php echo $loadUser->getAddressStreet() ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="number" class="col-lg-4 control-label">Numer domu:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="number" name="number"
                                   value=<?php echo $loadUser->getAddressNumber() ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-lg-4 control-label">Miejscowość:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="city" name="city"
                                   value=<?php echo $loadUser->getAddressCity() ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code" class="col-lg-4 control-label">Kod pocztowy:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="code" name="code"
                                   value=<?php echo $loadUser->getAddressCode() ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4 col-lg-offset-4">
                            <button type="submit" class="btn btn-primary">Zapisz</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
<?php
require 'templates/footer.php';