<?php
/*
 * @Description: 密码基础工具
 * @version: 
 * @Author: XQ <798908243@qq.com>
 * @Date: 2020-01-10 15:29:40
 * @LastEditTime : 2020-01-10 15:33:10
 */

namespace App\Lib;

use App\Exception\ValidateException;

class PasswordUtils {

    /**
     * @Description: 验证密码是否正确
     * @Author: XQ <798908243@qq.com>
     * @param $password_text 明文密码 $password_hash 密文密码 salt 盐
     * @return: 
     */
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

    /**
     * @Description: 密码加密
     * @Author: XQ <798908243@qq.com>
     * @param {type} 
     * @return: 
     */
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

    /**
     * @Description: 生成密码和盐
     * @Author: XQ <798908243@qq.com>
     * @param {type} 
     * @return: 
     */
    private static function _generate_password_hash($passowrd_text = '', $salt = '')
    {
        if(empty($passowrd_text) OR empty($salt))
        {
            throw new ValidateException();
        }
        return hash('sha256',$salt.$passowrd_text);
    }
}
