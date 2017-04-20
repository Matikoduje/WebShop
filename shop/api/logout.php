<?php

session_start();
if (isset($_SESSION['user'], $_SESSION['token'])) {
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    if (session_destroy()) {
        $msg = array('success' => 'OK');
    } else {
        $msg = array('error' => 'BAD');
    }

    echo json_encode($msg);
}
