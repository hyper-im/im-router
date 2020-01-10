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

namespace App\Model\Logic;

use App\Exception\ValidateException;
use App\Model\Validate\CodeValidate;
use Hyperf\Di\Annotation\Inject;

/**
 * Class CodeLogic
 * @package App\Model\Logic
 */
class CodeLogic
{
    /**
     * @Inject()
     * @var CodeValidate
     */
    protected $codeValidate;

    /**
     * 获取验证码
     * @param array $params
     */
    public function getcode(array $params){
        if(!$this->codeValidate->scene("getcode")->check($params)){
            throw new ValidateException($this->codeValidate->getError());
        }
    }
}
