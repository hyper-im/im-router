<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-02-27 23:03:56
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Validate;

use App\Utils\Validate\Validate;

/**
 * 用户逻辑层验证
 * Class UserValidate
 * @package App\Model\Validate
 */
class UserValidate extends Validate
{
    protected $rule = [
        'mobile'    => 'regex:/^1\d{10}$/',
        'password'  => 'require|length:6,20',
        'passwords'  => 'require|confirm:password',
        'captcha'   => 'require',
    ];

    protected $message = [

        'mobile.regex'     => '手机号码不合法',
        'password.require' => '密码不能为空',
        'password.length'  => '密码长度需要在6-20个字符',
        'passwords.length'  => '确认密码不能为空',
        'passwords.confirm'  => '两次密码不一致',
        'captcha.require'  => '验证码不能为空',
    ];

    protected $scene = [
        'register' => ['mobile', 'password', 'passwords', 'captcha'] ,
        'login' => ['mobile','password']
    ];
}
