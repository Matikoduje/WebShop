<?php

class User
{
    private $userId;
    private $userName;
    private $userSurname;
    private $userEmail;
    private $userPassword;

    public function __construct()
    {
        $this->userId = -1;
        $this->userEmail = '';
        $this->userName = '';
        $this->userSurname = '';
        $this->userPassword = '';
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getUserSurname()
    {
        return $this->userSurname;
    }

    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function setUserSurname($userSurname)
    {
        $this->userSurname = $userSurname;
    }

    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    }



}