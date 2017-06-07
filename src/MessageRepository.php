<?php

class MessageRepository
{
    static public function save(PDO $connection, Message $message)
    {
        $messageId = $message->getMessageId();
        $adminId = $message->getAdminId();
        $userId = $message->getUserId();
        $messageText = $message->getMessageText();
        $isMessageSent = $message->getIsMessageSent();
        $isMessageRead = $message->getIsMessageRead();

        if ($messageId == -1) {
            $sql = "INSERT INTO `messages` (`adminId`, `userId`, `messageText`, `isMessageSent`, `isMessageRead`)
                    VALUES (:adminId, :userId, :messageText, :isMessageSent, :isMessageRead)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":adminId", $adminId);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":messageText", $messageText);
            $stmt->bindParam(":isMessageSent", $isMessageSent);
            $stmt->bindParam(":isMessageRead", $isMessageRead);
            $stmt->execute();

            $messageId = $connection->lastInsertId();
            $newMessage = MessageRepository::loadMessageById($connection, $messageId);
            return $newMessage;
        } elseif ($messageId > 0) {
            $sql = "UPDATE messages SET adminId = :adminId,
                                         userId = :userId,
                                         messageText = :messageText,
                                         isMessageSent = :isMessageSent,
                                         isMessageRead = :isMessageRead
                    WHERE messageId = :messageId";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(":adminId", $adminId);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":messageText", $messageText);
            $stmt->bindParam(":isMessageSent", $isMessageSent);
            $stmt->bindParam(":isMessageRead", $isMessageRead);
            $stmt->execute();
            $savedMessage = MessageRepository::loadMessageById($connection, $messageId);
            return $savedMessage;
        }
    }

    static public function loadMessageById(PDO $connection, $messageId)
    {
        $sql = "SELECT * FROM messages WHERE messageId = :messageId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":messageId", $messageId);
        $stmt->execute();
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $message = new Message();
            $message->setMessageId($item['messageId']);
            $message->setAdminId($item['adminId']);
            $message->setUserId($item['userId']);
            $message->setMessageText($item['messageText']);
            $message->setIsMessageSent($item['isMessageSent']);
            $message->setIsMessageRead($item['isMessageRead']);
        }
        return $message;
    }

    static public function loadMessagesByUserId(PDO $connection, $userId)
    {
        $sql = "SELECT * FROM messages WHERE userId = :userId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        $messages = [];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $message = new Message();
            $message->setMessageId($item['messageId']);
            $message->setAdminId($item['adminId']);
            $message->setUserId($item['userId']);
            $message->setMessageText($item['messageText']);
            $message->setIsMessageSent($item['isMessageSent']);
            $message->setIsMessageRead($item['isMessageRead']);
            $messages[] = $message;
        }
        return $messages;
    }

    static public function setMessageAsSent($connection, $messageId)
    {
        $message = MessageRepository::loadMessageById($connection, $messageId);
        $message->setIsMessageSent(1);
        $savedMessage = MessageRepository::save($connection, $message);
        if ($savedMessage) {
            return true;
        } else {
            return false;
        }
    }

    static public function setMessageAsRead($connection, $messageId)
    {
        $message = MessageRepository::loadMessageById($connection, $messageId);
        $message->setIsMessageRead(1);
        $savedMessage = MessageRepository::save($connection, $message);
        if ($savedMessage) {
            return true;
        } else {
            return false;
        }
    }

}