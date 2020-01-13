<?php

/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.hyperpay.me All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：20-1-10 上午12:52
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Http\Im;


use App\Controller\AbstractController;
use App\Exception\ServiceException;
use App\Services\UserService;
use Hyperf\Consul\Client;
use Hyperf\Di\Annotation\Inject;

class UserController extends AbstractController
{
    /**
     * @Inject()
     * @var UserService
     */
    protected $userService;

    /**
     * 注册
     */
    public function register(){
        $username = $this->request->query("username");
        $password = $this->request->query("password");
        $result = $this->userService->register($username,$password);
        return success(null);
    }

    /**
     * 登录, 成功后, 返回token和im-server信息
     */
    public function login(){

        $username = $this->request->query("username");
        $password = $this->request->query("password");
        try{
            if($user = $this->userService->checkPassword($username,$password))
            {
                $token = $this->userService->generateToken($user);
                $data['token'] = $token;
                return success($data);
            }
        }
        catch (ServiceException $e)
        {
            return error($e->getMessage(),null);
        }
    }

    /**
     * 退出
     */
    public function logout()
    {
        return 'logout';
    }

    public function consul(){

        $client = $this->container->get(Client::class);
        var_dump($client);
        $result = $client->put('im-server','127.0.0.1:9501');
        return $result;
    }
}
