<?php

function __autoload($className)
{
    include_once '../../src/' . $className . '.php';
}

session_start();

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['quantity']) && ($_POST['jsSession'] === $_SESSION['token'])) {
        try {
            $conn = new Connection();
            $conn = $conn->doConnect();
            $basket = unserialize($_SESSION['basket']);
            $basket->addItem(1,10);
            $_SESSION['basket'] = serialize($basket);
        } catch (Exception $e) {
            $msg = array('type' => 'error',
                'msg' => $e->getMessage(),
                'color' => 'danger');
            echo json_encode($msg);
        }
    } else {
        $data = array(
            'error' => 'Błąd'
        );
    }
}
