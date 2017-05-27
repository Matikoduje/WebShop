<?php

class AdminRepository
{
        static public function loadAdminByEmail(PDO $connection, $adminEmail)
    {
        $stmt = $connection->prepare("SELECT * FROM admins WHERE adminEmail = :adminEmail");
        $stmt->bindParam(":adminEmail", $adminEmail);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            foreach ($stmt as $item) {
                $admin = new Admin();
                $admin->setAdminId($item['adminId']);
                $admin->setAdminEmail($item['adminEmail']);
                $admin->setAdminLogin($item['adminLogin']);
                $admin->setAdminPassword($item['adminPassword']);
                return $admin;
            }
        } else {
            return null;
        }
    }

    static public function loadAdminById (PDO $connection, $adminId)
    {
        $stmt = $connection->prepare("SELECT * FROM admins WHERE adminId = :adminId");
        $stmt->bindParam(":adminId", $adminId);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            foreach ($stmt as $item) {
                $admin = new Admin();
                $admin->setAdminId($item['adminId']);
                $admin->setAdminEmail($item['adminEmail']);
                $admin->setAdminLogin($item['adminLogin']);
                $admin->setAdminPassword($item['adminPassword']);
                return $admin;
            }
        } else {
            return null;
        }
    }

//    static public function loadAdminByParameter (PDO $connection, $paramName, $paramValue) //adminLogin.php, adminPanel.php
//    {
//        $stmt = $connection->prepare("SELECT * FROM admins WHERE $paramName = :paramValue");
//        $stmt->bindParam(":paramValue", $paramValue);
//        $stmt->execute();
//        if ($stmt->rowCount() == 1) {
//            foreach ($stmt as $item) {
//                $admin = new Admin();
//                $admin->setAdminId($item['adminId']);
//                $admin->setAdminEmail($item['adminEmail']);
//                $admin->setAdminLogin($item['adminLogin']);
//                $admin->setAdminPassword($item['adminPassword']);
//                return $admin;
//            }
//        } else {
//            return null;
//        }
//    }

}