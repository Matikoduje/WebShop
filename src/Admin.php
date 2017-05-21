<?php

class Admin
{
    private $adminId;
    private $adminEmail;
    private $adminLogin;
    private $adminPassword;

    public function __construct()
    {
        $this->adminId = -1;
        $this->adminEmail = "";
        $this->adminLogin = "";
        $this->adminPassword = "";
    }

    public function getAdminId(): int
    {
        return $this->adminId;
    }

    public function setAdminId(int $adminId)
    {
        $this->adminId = $adminId;
    }

    public function getAdminEmail(): string
    {
        return $this->adminEmail;
    }

    public function setAdminEmail(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function getAdminLogin(): string
    {
        return $this->adminLogin;
    }

    public function setAdminLogin(string $adminLogin)
    {
        $this->adminLogin = $adminLogin;
    }

    public function getAdminPassword(): string
    {
        return $this->adminPassword;
    }

    public function setAdminPassword(string $adminPassword) // przy walidacji hasło zahashowane przekazane do obiektu obiektu
    {
        $this->adminPassword = $adminPassword;
    }

    public function setAdminHashedPassword(string $adminPassword)
    {
        $this->adminPassword = password_hash($adminPassword, PASSWORD_BCRYPT); // na stałe do bazy danych / przy zmianie hasła
    }

}