<?php

class UserCheck
{

    private $user;

    private function checkUserFirstName()
    {
        if ($this->user->getUserFirstName() == '' && !isset($_POST['name'])) {
            throw new Exception('Nie przesłano wszystkich danych z strony na serwer');
        }
        $name = $_POST['name'];
        if (strlen($name) >= 3 && strlen($name) <= 60) {
            $this->user->setUserFirstName($name);
        } else {
            throw new Exception('Proszę podać imię o poprawnej długości znaków');
        }
    }

    private function checkUserLastName()
    {
        if ($this->user->getUserLastName() == '' && !isset($_POST['surname'])) {
            throw new Exception('Nie przesłano wszystkich danych z strony na serwer');
        }
        $surname = $_POST['surname'];
        if (strlen($surname) >= 3 && strlen($surname) <= 60) {
            $this->user->setUserLastName($surname);
        } else {
            throw new Exception('Proszę podać nazwisko o poprawnej długości znaków');
        }
    }

    private function checkUserLogin()
    {
        if ($this->user->getUserLogin() == '' && !isset($_POST['login'])) {
            throw new Exception('Nie przesłano wszystkich danych z strony na serwer');
        }
        $login = $_POST['login'];
        if (strlen($login) >= 5 && strlen($login) <= 60) {
            $this->user->setUserLogin($login);
        } else {
            throw new Exception('Proszę podać login o poprawnej długości znaków');
        }
    }

    private function checkUserEmail()
    {
        if ($this->user->getUserEmail() == '' && !isset($_POST['email'])) {
            throw new Exception('Nie przesłano wszystkich danych z strony na serwer');
        }
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->user->setUserEmail($email);
        } else {
            throw new Exception('Proszę podać poprawny e-mail');
        }
    }

    private function checkUserPassword()
    {
        if ($this->user->getUserPassword() == '' && !isset($_POST['password1'], $_POST['password2'])) {
            throw new Exception('Nie przesłano wszystkich danych z strony na serwer');
        }
        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];
        if ($pass1 != $pass2) {
            throw new Exception('Hasła różnią się od siebie');
        }
        if (strlen($pass1) >= 5 && strlen($pass1) <= 60) {
            $this->user->setUserPassword($pass1);
        } else {
            throw new Exception('Proszę podać hasło o odpowiedniej długości');
        }
    }

    public function checkAddressCity()
    {
        $city = $_POST['city'];
        if (strlen($city) >= 3 && strlen($city) <= 60) {
            $this->user->setAddressCity($city);
        } else {
            throw new Exception('Proszę wprowadzić poprawną nazwę miasta');
        }
    }

    public function checkAddressCode()
    {
        $code = $_POST['code'];
        if (strlen($code) == 6) {
            $this->user->setAddressCode($code);
        } else {
            throw new Exception('Proszę wprowadzić kod pocztowy w poprawnym formacie XX-XXX');
        }
    }

    public function checkAddressStreet()
    {
        $street = $_POST['street'];
        if (strlen($street) >= 3 && strlen($street) <= 255) {
            $this->user->setAddressStreet($street);
        } else {
            throw new Exception('Proszę wprowadzić poprawną nazwę ulicy');
        }
    }

    public function checkAddressNumber()
    {
        $number = $_POST['number'];
        if (strlen($number) >= 1 && strlen($number) <= 10) {
            $this->user->setAddressNumber($number);
        } else {
            throw new Exception('Proszę wprowadzić poprawny numer domu bądź mieszkania');
        }

    }

    public function save(User $user)
    {
        $this->user = $user;

        $this->checkUserFirstName();
        $this->checkUserLastName();
        $this->checkUserLogin();
        $this->checkUserEmail();
        $this->checkUserPassword();

        return $this->user;
    }

    public function changePassword(User $user)
    {
        $this->user = $user;

        $this->checkUserPassword();

        return $this->user;
    }

    public function update(User $user)
    {
        $this->user = $user;

        $this->checkUserFirstName();
        $this->checkUserLastName();
        $this->checkUserEmail();

        if (isset($_POST['street']) && $_POST['street'] != '') {
            $this->checkAddressStreet();
        }
        if (isset($_POST['number']) && $_POST['number'] != '') {
            $this->checkAddressNumber();
        }
        if (isset($_POST['city']) && $_POST['city'] != '') {
            $this->checkAddressCity();
        }
        if (isset($_POST['code']) && $_POST['code'] != '') {
            $this->checkAddressCode();
        }

        return $this->user;
    }
}