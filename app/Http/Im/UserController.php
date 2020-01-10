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

        $username = $this->request->post("username");
        $password = $this->request->post("password");
        $result = $this->userService->register($username,$password);
        return $result;
    }

    /**
     * 登录, 成功后, 返回token和im-server信息
     */
    public function login(){

        //获取consul客户端
        $client_consul = $this->container->get(\Hyperf\Consul\KV::class);
        return 'login';
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
