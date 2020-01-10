<?php

namespace App\Services;

use App\Exception\ServiceException;
use App\Lib\PasswordUtils;
use App\Model\User;

class UserService {

    public function register($username,$password)
    {
        $user = User::query()->where('username',$username)->first();
        if($user)
        {
           throw new ServiceException("用户名已被占用");
        }
        $userModel = new User();
        $userModel->username = $username;
        $password_encryption = PasswordUtils::encryptPassword($password);
        $userModel->password_hash = $password_encryption['password_hash'];
        $userModel->salt = $password_encryption['salt'];
        $userModel->created_at = time();
        $userModel->updated_at = time();
        if($userModel->save())
        {
            return True;
        }
        else
        {
            return False;
        }
    }
}