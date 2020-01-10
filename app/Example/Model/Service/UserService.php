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

namespace App\Model\Service;

use App\Exception\ServiceException;
use App\Model\Dao\UserDao;
use Hyperf\Di\Annotation\Inject;

/**
 * 用户服务层,业务逻辑
 * Class UserService
 * @package App\Model\Service
 */
class UserService
{

    /**
     * @Inject()
     * @var CodeService
     */
    protected $codeService;

    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

    /**
     * 用户注册
     * @param array $data
     */
    public function register(array $data){

        if($this->userDao->getUserByMobile($data['mobile'])){
            throw new ServiceException("该手机号已注册,请直接登录！");
        }

        //校验验证码是否正确
        $this->codeService->checkCode($data['mobile'], $data['captcha']);

        //用户注册
        $this->userDao->create($data);
    }


}
