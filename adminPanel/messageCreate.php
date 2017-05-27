<?php
require_once "templates/adminHeader.php";
var_dump($_SESSION);
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>

    <h3>Panel Administratora / napisz wiadomość do użytkownika</h3>
    <form method="post" action="#">
        <select name="userID">
            <?php

            ?>
        </select>
        <textarea name="messageText">wiadomość max 255 znaków</textarea>
        <input type="submit" value="wyślij">
    </form>


    <?php

        if($_SERVER['REQUEST_METHOD'] == "true") {
            if (isset($_POST['messageText']) && isset($_SESSION['adminId'])) {
                $messageText = $_POST['messageText'];
                $adminId = $_SESSION['adminId'];
                $userId = $_POST['userId'];
                $message = new Message();
                $message->setAdminId($adminId);
                $message->setUserId($userId);
                $message->setMessageText($messageText);
                $message->getIsMessageSent(1);
                $newMessage = MessageRepository::save($connection, $message);
                //TODO: od tego momentu kontynuować
            }
        }



    ?>

</body>
</html>