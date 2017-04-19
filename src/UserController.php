<?php

class UserController implements ControllerInterface
{
    public function save(RepositoryInterface $repository)
    {
        $user = new User();
        $checkedUser = new UserCheck();
        $checkedUser = $checkedUser->save($user);
        $repository->find('userLogin', $checkedUser->getUserLogin(), 'users');
        $repository->find('userEmail', $checkedUser->getUserEmail(), 'users');
        $repository->save($checkedUser, 'users');
    }

    public function load(RepositoryInterface $repository, $login, $password, $isSetSession)
    {
        $user = $repository->load('userLogin', $login, 'users', 'User');
        $userPassword = $user->getUserPassword();
        if (password_verify($password, $userPassword) == false) {
            unset($user);
            throw new Exception("Podano nie prawidłowy login bądź hasło");
        } else {
            if ($isSetSession == 'no') {
                $userId = $user->getUserId();
                return $userId;
            } else {
                return $user;
            }
        }
    }

    public function update(RepositoryInterface $repository, ObjectInterface $user)
    {
        $checkedUser = new UserCheck();
        $checkedUser = $checkedUser->update($user);
        $repository->find('userEmail', $checkedUser->getUserEmail(), 'users');
        $repository->save($checkedUser, 'users');
    }

    public function changePassword(RepositoryInterface $repository, ObjectInterface $user)
    {
        $checkedUser = new UserCheck();
        $checkedUser = $checkedUser->changePassword($user);
        $repository->save($checkedUser, 'users');
    }

}