<?php

function __autoload($className)

{
    include_once '../../src/' . $className . '.php';
}

session_start();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'], $_POST['email'], $_POST['password1'], $_POST['name'], $_POST['surname'], $_POST['password2'], $_POST['isAccepted'])) {
        $isAccepted = $_POST['isAccepted'];
        if ($isAccepted == true) {
            try {
                $controller = new UserController();
                $repository = new UserRepository();
                $controller->save($repository);
                unset($controller, $repository);
                $msg = array('type' => 'success',
                    'msg' => 'Rejestracja przebiegła pomyślnie. Zapraszamy do logowania',
                    'color' => 'success');
                echo json_encode($msg);
            } catch (Exception $e) {
                $msg = array('type' => 'error',
                    'msg' => $e->getMessage(),
                    'color' => 'danger');
                echo json_encode($msg);
            }
        } else {
            $msg = array('type' => 'error',
                'msg' => 'Proszę zapoznać się z warunkami korzystania z serwisu',
                'color' => 'info');
            echo json_encode($msg);
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loginLogin'], $_POST['loginPassword'])) {
        $login = $_POST['loginLogin'];
        $pass = $_POST['loginPassword'];
        try {
            $controller = new UserController();
            $repository = new UserRepository();
            $loadUser = $controller->load($repository, $login, $pass);
            $_SESSION['user'] = serialize($loadUser);
            $_SESSION['token'] = uniqid('user');
            unset($controller, $repository, $loadUser);
            $dataPack = array('token' => $_SESSION['token'],
                'type' => 'success',
                'msg' => 'Zalogowałeś się. Życzymy przyjemnych zakupów',
                'color' => 'success');
            echo json_encode($dataPack);
        } catch (Exception $e) {
            $msg = array('type' => 'error',
                'msg' => $e->getMessage(),
                'color' => 'danger');
            echo json_encode($msg);
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password2'], $_POST['password1'], $_POST['jsSession'])) {
        if ($_POST['jsSession'] === $_SESSION['token'] && isset($_SESSION['user'])) {
            $loadUser = unserialize($_SESSION['user']);
            try {
                $controller = new UserController();
                $repository = new UserRepository();
                $controller->changePassword($repository, $loadUser);
                unset($loadUser);
                $msg = array('type' => 'success',
                    'msg' => 'Hasło zostało zmienione',
                    'color' => 'success');
                echo json_encode($msg);
            }
            catch (Exception $e) {
                $msg = array('type' => 'error',
                    'msg' => $e->getMessage(),
                    'color' => 'danger');
                echo json_encode($msg);
            }
        } else {
            $msg = array('type' => 'error',
                'msg' => 'Problem z nawiązaniem połączenia z serwerem',
                'color' => 'danger');
            echo json_encode($msg);
        }
    } else {
        $msg = array('type' => 'error',
            'msg' => 'Nie zostały przekazane wszystkie wymagane informacje',
            'color' => 'danger');
        echo json_encode($msg);
    }
}

