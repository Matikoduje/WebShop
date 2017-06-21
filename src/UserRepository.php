<?php

class UserRepository implements RepositoryInterface
{
    protected $conn;
    protected $tableName;
    protected $preparedStatement;

    public function load($loadOption, $loadOptionValue, $tableName, $returnObjectClass)
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->doConnect();
        $this->tableName = $tableName;

        try {
            $this->preparedStatement = $this->conn->prepare("SELECT * FROM " . $tableName . " WHERE " . $loadOption . "=:loadOptionValue");
            $this->preparedStatement->bindParam(':loadOptionValue', $loadOptionValue);
            $this->preparedStatement->execute();
            if ($this->preparedStatement->rowCount()) {
                $row = $this->preparedStatement->fetch();
                $user = new $returnObjectClass();
                $user->setUserId($row['userId']);
                $user->setUserFirstName($row['userFirstName']);
                $user->setUserLastName($row['userLastName']);
                $user->setUserLogin($row['userLogin']);
                $user->setUserEmail($row['userEmail']);
                $user->setUserHash($row['userPassword']);
                $user->setAddressCode($row['addressCode']);
                $user->setAddressCity($row['addressCity']);
                $user->setAddressNumber($row['addressNumber']);
                $user->setAddressStreet($row['addressStreet']);
                $this->conn = null;
                return $user;
            } else {
                $this->conn = null;
                throw new Exception('Podano nie prawidłowy login bądź hasło');
            }
        }
        catch (PDOException $e) {
            $this->conn = null;
            throw new Exception('Nie można wczytać danych z tabeli');
        }
    }

    public function save(ObjectInterface $user, $tableName)
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->doConnect();
        $this->tableName = $tableName;
        if ($user->getUserId() == -1) {
            try {
                $this->preparedStatement = $this->conn->prepare("INSERT INTO " . $this->tableName . " (`userFirstName`,
                `userLastName`, `userLogin`, `userPassword`, `userEmail`)
                VALUES (:userFirstName, :userLastName, :userLogin, :userPassword, :userEmail)");
                $this->preparedStatement->bindValue(':userLogin', $user->getUserLogin());
                $this->preparedStatement->bindValue(':userPassword', $user->getUserPassword());
                $this->preparedStatement->bindValue(':userEmail', $user->getUserEmail());
                $this->preparedStatement->bindValue(':userFirstName', $user->getUserFirstName());
                $this->preparedStatement->bindValue(':userLastName', $user->getUserLastName());
                $this->preparedStatement->execute();
            } catch (PDOException $e) {
                $this->conn = null;
                throw new Exception("Przepraszamy chwilowo mamy problemy z serwerem bazy danych. Proszę spróbować zarejestrować się za chwilę");
            }
        } else {
            try {
                $this->preparedStatement = $this->conn->prepare("UPDATE `users` SET `userFirstName`=:userFirstName,
                `userLastName`=:userLastName, `userLogin`=:userLogin, `userPassword`=:userPassword,
                `userEmail`=:userEmail, `addressCity`=:addressCity, `addressCode`=:addressCode,
                `addressStreet`=:addressStreet, `addressNumber`=:addressNumber WHERE userId=:userId");

                $this->preparedStatement->bindValue(':userId', $user->getUserId());
                $this->preparedStatement->bindValue(':userFirstName', $user->getUserFirstName());
                $this->preparedStatement->bindValue(':userLastName', $user->getUserLastName());
                $this->preparedStatement->bindValue(':userLogin', $user->getUserLogin());
                $this->preparedStatement->bindValue(':userPassword', $user->getUserPassword());
                $this->preparedStatement->bindValue(':addressCity', $user->getAddressCity());
                $this->preparedStatement->bindValue(':addressCode', $user->getAddressCode());
                $this->preparedStatement->bindValue(':addressNumber', $user->getAddressNumber());
                $this->preparedStatement->bindValue(':addressStreet', $user->getAddressStreet());
                $this->preparedStatement->bindValue(':userEmail', $user->getUserEmail());

                $this->preparedStatement->execute();
            } catch (PDOException $e) {
                $this->conn = null;
                throw new Exception("Przepraszamy chwilowo mamy problemy z serwerem bazy danych. Nie można zapisać danych");
            }
        }
        $this->conn = null;
    }

    public function find($findTerm, $findValue, $tableName)
    {
        $this->conn = new Connection();
        $this->conn = $this->conn->doConnect();
        $this->tableName = $tableName;

        try {
            $this->preparedStatement = $this->conn->prepare("SELECT * FROM " . $this->tableName . " WHERE " . $findTerm . "=:findValue");
            $this->preparedStatement->bindValue(':findValue', $findValue);
            $this->preparedStatement->execute();
        }
        catch (PDOException $e) {
            $this->conn = null;
            throw new Exception('Przepraszamy wystąpił błąd przy wyszukiwaniu frazy w bazie danych');
        }
        if ($this->preparedStatement->rowCount()) {
            if (isset($_SESSION['user'])) {
                $row = $this->preparedStatement->fetch();
                $loadUser = unserialize($_SESSION['user']);
                if ($row['userEmail'] == $loadUser->getUserEmail()) {
                    unset($loadUser);
                    return;
                } else {
                    throw new Exception('W bazie danych istnieje już użytkownik o podanym e-mailu. Proszę go zmienić');
                }
            }
            $this->conn = null;
            if ($findTerm == "userLogin") {
                throw new Exception('W bazie danych istnieje już użytkownik o podanym loginie. Proszę go zmienić');
            } else if ($findTerm == "userEmail") {
                throw new Exception('W bazie danych istnieje już użytkownik o podanym e-mailu. Proszę go zmienić');
            }
        }
        $this->conn = null;
    }

    static public function loadAllUsers(PDO $connection) //++
    {
        $sql = "SELECT * FROM users";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $usersArray = [];
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->setUserId($item['userId']);
            $user->setUserFirstName($item['userFirstName']);
            $user->setUserLastName($item['userLastName']);
            $user->setUserLogin($item['userLogin']);
            $user->setUserEmail($item['userEmail']);
            $user->setAddressCity($item['addressCity']);
            $user->setAddressCode($item['addressCode']);
            $user->setAddressStreet($item['addressStreet']);
            $user->setAddressNumber($item['addressNumber']);
            $usersArray[] = $user;
        }
        return $usersArray;
    }

    public static function loadUserById(PDO $connection, $userId) //++
    {
        $sql = "SELECT * FROM users WHERE userId = :userId";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->setUserId($item['userId']);
            $user->setUserFirstName($item['userFirstName']);
            $user->setUserLastName($item['userLastName']);
            $user->setUserLogin($item['userLogin']);
            $user->setUserEmail($item['userEmail']);
            $user->setAddressCity($item['addressCity']);
            $user->setAddressCode($item['addressCode']);
            $user->setAddressStreet($item['addressStreet']);
            $user->setAddressNumber($item['addressNumber']);
        }
        return $user;
    }

}