<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/13 10:59 AM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */
namespace App\Http\Server;

use App\Services\UserService;
use Hyperf\Di\Annotation\Inject;

class UserController extends ServerBaseController
{

    /**
     * @Inject()
     * @var UserService
     */
    protected $userService;

    public function verifyToken()
    {
        $token = $this->request->query("token");
        $data = $this->userService->checkToken($token);
        return success($data);
    }
}