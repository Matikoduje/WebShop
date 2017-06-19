<?php

require_once "templates/adminHeader.php";

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
        <div>wybierz użytkownika, do którego chcesz napisać</div>
        <select name="userId">
            <?php
                $usersArray = UserRepository::loadAllUsers($connection);
                foreach ($usersArray as $user) {
                    $userId = $user->getUserId();
                    $userEmail = $user->getUserEmail();
                    echo "<option value = '" . $userId . "'>" . $userEmail . "</option>";
                }
            ?>
        </select>
        <div>wpisz wiadomość</div>
        <textarea name="messageText">wiadomość max 255 znaków</textarea>
        <input type="hidden" name="action" value="createMessage" />
        <input type="submit" value="wyślij">
    </form>


    <?php

        if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == 'createMessage') {
            if (isset($_POST['messageText']) && isset($_POST['userId']) && isset($_SESSION['adminId'])) {
                $messageText = $_POST['messageText'];
                $userId = $_POST['userId'];
                $adminId = $_SESSION['adminId'];
                $message = new Message();
                $message->setAdminId($adminId);
                $message->setUserId($userId);
                $message->setMessageText($messageText);
                $message->setIsMessageSent(1);
                $newMessage = MessageRepository::save($connection, $message);
                if ($newMessage) {
                    echo sprintf("Pomyślnie wysłano wiadomość do użytkownika id: %d  na email: %s",
                        $newMessage->getUserId(),
                        UserRepository::loadUserById($connection, $newMessage->getUserId())->getUserEmail()
                    );
                }
            }
        }



    ?>

</body>
</html>