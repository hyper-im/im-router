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
 * 币种验证层
 * Class CoinValidate
 * @package App\Model\Validate
 */
class CoinValidate extends Validate
{
    protected $rule = [
        'coinId' => 'require|integer',
    ];

    protected $message = [
        'coinId.require' => '币种coinId不能为空',
        'coinId.integer' => '币种coinId必须为int',
    ];

    protected $scene = [
        'detail' => ['coinId'],
    ];
}
