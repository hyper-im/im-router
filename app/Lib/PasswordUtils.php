<?php


namespace App\Lib;

use App\Exception\ValidateException;

class PasswordUtils {

    public static function verifyPassword($password_text = '', $password_hash = '', $salt = '')
    {
        if(empty($password_text) OR empty($password_hash) OR empty($salt))
        {
            throw new ValidateException();
        }
        $correct_password = self::_generate_password_hash($password_text,$salt);
        if($correct_password === $password_hash)
        {
            return True;
        }
        return False;
    }

    public static function encryptPassword($password_text)
    {
        if(empty($password_text))
        {
            throw new ValidateException();
        }
        $salt = random_salt(8);
        $password_hash = self::_generate_password_hash($password_text,$salt);
        return ['password_hash' => $password_hash,'salt' => $salt];
    }


    private static function _generate_password_hash($passowrd_text = '', $salt = '')
    {
        if(empty($passowrd_text) OR empty($salt))
        {
            throw new ValidateException();
        }
        return hash('sha256',$salt.$passowrd_text);
    }
}
