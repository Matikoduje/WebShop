<?php
session_start();
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['token'], $_SESSION['user'])) {
        if ($_POST['jsSession'] === $_SESSION['token']) {
            $dataPack = array(
                'type' => 'success');
        } else {
            $dataPack = array(
                'type' => 'error');
        }
        echo json_encode($dataPack);
    }
}