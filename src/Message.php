<?php


class Message
{
    private $messageId;
    private $adminId;
    private $userId;
    private $messageText;
    private $isMessageSent;
    private $isMessageRead;
    private $messageTitle;
    private $messageDate;

    public function __construct()
    {
        $this->messageId = -1;
        $this->adminId = -1;
        $this->userId = -1;
        $this->messageText = "";
        $this->isMessageSent = 0;
        $this->isMessageRead = 0;
        $this->messageTitle = "";
        $this->setMessageDate();
    }

    public function getMessageTitle()
    {
        return $this->messageTitle;
    }

    public function setMessageTitle($messageTitle)
    {
        $this->messageTitle = $messageTitle;
    }

    public function getMessageDate()
    {
        return $this->messageDate;
    }

    public function setMessageDate()
    {
        $this->messageDate = date('Y-m-d');
    }

    public function getMessageId(): int
    {
        return $this->messageId;
    }

    public function setMessageId(int $messageId)
    {
        $this->messageId = $messageId;
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId)
    {
        $this->adminId = $adminId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function getMessageText(): string
    {
        return $this->messageText;
    }

    public function setMessageText(string $messageText)
    {
        $this->messageText = $messageText;
    }

    public function getIsMessageSent(): int
    {
        return $this->isMessageSent;
    }

    public function setIsMessageSent(int $isMessageSent)
    {
        $this->isMessageSent = $isMessageSent;
    }

    public function getIsMessageRead(): int
    {
        return $this->isMessageRead;
    }

    public function setIsMessageRead(int $isMessageRead)
    {
        $this->isMessageRead = $isMessageRead;
    }

}