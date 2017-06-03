<?php

function __autoload($className)

{
    include_once '../../src/' . $className . '.php';
}

session_start();

function serializeMessage(Message $message)
{
    return array(
        'id' => $message->getMessageId(),
        'messageText' => $message->getMessageText(),
        'messageTitle' => $message->getMessageTitle(),
        'messageDate' => $message->getMessageDate(),
        'isRead' => $message->getIsMessageRead()
    );
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if ($_POST['jsSession'] === $_SESSION['token'] && isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $loadUser = unserialize($_SESSION['user']);
        $conn = new Connection();
        $conn = $conn->doConnect();
        $messages = MessageRepository::loadMessagesByUserId($conn, $loadUser->getUserId());
        unset($loadUser);
        $conn = null;
        $data = array ('messages' => array());
        foreach ($messages as $message) {
            $data['messages'][] = serializeMessage($message);
        }
        echo json_encode($data);
    }
}
