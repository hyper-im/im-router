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
use App\Model\Validate\UserValidate;
use Hyperf\Di\Annotation\Inject;

/**
 * 用户逻辑验证层
 * Class UserLogic
 * @package App\Model\Logic
 */
class UserLogic
{

    /**
     * @Inject()
     * @var UserValidate
     */
    protected $userValidate;

    /**
     * 用户注册
     * @param array $params
     */
    public function register(array $data){
        if(!$this->userValidate->scene('register')->check($data))
        {
            throw new ValidateException($this->userValidate->getError());
        }

        $data['joinip'] = '';

    }
}
