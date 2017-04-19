<?php

class UserTest extends AbstractDatabaseTest
{
    // sprawdzamy czy połączenie dobrze odczytało dane zapisane w XML
    public function testConnection()
    {
        $pdo = $this->getConnection()->getConnection();
        $result = $pdo->query('SELECT * FROM `users`');
        $this->assertGreaterThan(0,$result->rowCount());
    }

    public function testCreateNewUserAndSetValues()
    {
        $user = new User();
        $user->setUserLogin('admin');
        $user->setUserEmail('admin@onet.pl');
        $user->setUserPassword('admin');
        $user->setUserFirstName('Jan');
        $user->setUserLastName('Kowalski');
        $user->setAddressCity('Katowice');
        $user->setAddressCode('33-222');
        $user->setAddressStreet('Katowicka');
        $user->setAddressNumber('10');
        $this->assertEquals('admin',$user->getUserLogin());
        $this->assertEquals('admin@onet.pl',$user->getUserEmail());
        $this->assertEquals('Jan',$user->getUserFirstName());
        $this->assertEquals('Kowalski', $user->getUserLastName());
        $this->assertEquals('Katowice',$user->getAddressCity());
        $this->assertEquals('33-222',$user->getAddressCode());
        $this->assertEquals('Katowicka',$user->getAddressStreet());
        $this->assertEquals('10', $user->getAddressNumber());
        $this->assertTrue(password_verify('admin', $user->getUserPassword()));
    }

    public function testLoadFromDB()
    {
        $controller = new UserController();
        $repository = new UserRepository();
        $user = $controller->load($repository, 'JanNowak', 'admin');
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(1, $user->getUserId());
    }

    public function testLoadFromDBBadLogin()
    {
        $this->expectException(Exception::class);
        $controller = new UserController();
        $repository = new UserRepository();
        $user = $controller->load($repository, 'JanNowak', 'macki');
    }

    public function testSaveAndLoadFromDB()
    {
        $controller = new UserController();
        $repository = new UserRepository();

        $user = new User();
        $user->setUserLogin('admin');
        $user->setUserEmail('admin@onet.pl');
        $user->setUserPassword('admin');
        $user->setUserFirstName('Jan');
        $user->setUserLastName('Kowalski');
        $repository->save($user, 'users');
        unset($user);
        $user = $controller->load($repository, 'admin', 'admin');
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('admin', $user->getUserLogin());
    }
}