<?php

namespace App\Services;

use App\Exception\ServiceException;
use App\Exception\ValidateException;
use App\Lib\JwtPassport;
use App\Lib\PasswordUtils;
use App\Model\User;
use Mockery\Generator\StringManipulation\Pass\Pass;

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

    public function checkPassword($username,$password)
    {
        $user = User::query()->where('username',$username)->first();
        if(!$user)
        {
            throw new ServiceException("User Not Found");
        }
        if(PasswordUtils::verifyPassword($password,$user['password_hash'],$user['salt']))
        {
            return $user;
        }
        else
        {
            throw new ValidateException("Password Error");
        }
    }

    public function generateToken($userInfo)
    {
        if (!$userInfo)
        {
            throw new ValidateException("Params Error");
        }
        $data = [
            'user_id' => $userInfo['id'],
            'username' => $userInfo['username'],
        ];
        $token = JwtPassport::getToken($data);
        return $token;
    }

    public function checkToken($token)
    {
        $passport_result = JwtPassport::checkToken($token);
        if($passport_result['code'] === 200)
        {
            return success($passport_result['data']);
        }
        else
        {
            return error($passport_result['msg'],null);
        }

    }
}