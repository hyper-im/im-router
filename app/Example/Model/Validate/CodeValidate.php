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
 * Class CodeValidate
 * @package App\Model\Validate
 */
class CodeValidate extends Validate
{
    protected $rule = [
        'mobile' => 'require|mobile'
    ];

    protected $message = [
        'mobile.require' => '手机号码必须填写',
        'mobile.mobile' => '手机号码格式不正确',
    ];

    protected $scene = [
        'getcode' => [ 'mobile']
    ];
}
