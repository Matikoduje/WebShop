<?php

class User implements ObjectInterface
{
    private $userId;
    private $userFirstName;
    private $userLastName;
    private $userLogin;
    private $userEmail;
    private $userPassword;
    private $addressCity;
    private $addressCode;
    private $addressStreet;
    private $addressNumber;

    public function __construct()
    {
        $this->userId = -1;
        $this->userEmail = '';
        $this->userFirstName = '';
        $this->userLastName = '';
        $this->userPassword = '';
        $this->userLogin = '';
        $this->addressCity = '';
        $this->addressCode = '';
        $this->addressNumber = '';
        $this->addressStreet = '';
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setUserFirstName($userFirstName)
    {
        $this->userFirstName = $userFirstName;
    }

    public function setUserLastName($userLastName)
    {
        $this->userLastName = $userLastName;
    }

    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;
    }

    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    }

    public function setUserHash($userPassword)
    {
        $this->userPassword = $userPassword;
    }

    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;
    }

    public function setAddressCode($addressCode)
    {
        $this->addressCode = $addressCode;
    }

    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;
    }

    public function setAddressNumber($addressNumber)
    {
        $this->addressNumber = $addressNumber;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserFirstName()
    {
        return $this->userFirstName;
    }

    public function getUserLastName()
    {
        return $this->userLastName;
    }

    public function getUserLogin()
    {
        return $this->userLogin;
    }

    public function getUserEmail()
    {
        return $this->userEmail;
    }

    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function getAddressCity()
    {
        return $this->addressCity;
    }

    public function getAddressCode()
    {
        return $this->addressCode;
    }

    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    public function getAddressNumber()
    {
        return $this->addressNumber;
    }

}