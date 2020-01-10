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

namespace App\Controller\v1;

use App\Controller\Controller;
use App\Model\Logic\UserLogic;
use App\Model\Service\UserService;
use App\Utils\DingTalk;
use Firebase\JWT\JWT;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\RequestMapping;

/**
 * Class UserController
 * @package App\Controller
 * @\Hyperf\HttpServer\Annotation\Controller(prefix="/v1/user")
 */
class UserController extends Controller
{

    /**
     * @Inject()
     * @var UserLogic
     */
    protected $userLogic;

    /**
     * @Inject()
     * @var UserService
     */
    protected $userService;

    /**
     * @Inject()
     * @var DingTalk
     */
    protected $dd;


    /**
     * @RequestMapping(path="register")
     */
    public function register()
    {
        $data = $this->request->post();
        $this->userLogic->register($data);

        //joinip
        $data['joinip'] = $this->request->server("remote_addr", "");

        $this->userService->register($data);
        return ['code' => 200, 'msg'=> '注册成功'];
    }

    /**
     * @RequestMapping(path="login")
     */
    public function login()
    {
        $config_jwt = config('jwt');
        $data['uid'] = 12;
        $data = array_merge($config_jwt['token'], $data);
        return JWT::encode($data,$config_jwt['key']);
    }

    /**
     * @RequestMapping(path="dd")
     */
    public function dd()
    {

//        $dingTalk = new DingTalk();
//        return $this->dd->setMsgType(DingTalk::MSG_TYPE_TEXT)
//            ->setMessage("这是测试信息")
//            ->setAtAll()
//            ->send();

//        return $this->dd->setMsgType(DingTalk::MSG_TYPE_LINK)
//            ->setMessage("这是LInk消息")
//            ->setTitle("link标题")
//            ->setPicUrl("http://img1.imgtn.bdimg.com/it/u=1739741944,1672422633&fm=26&gp=0.jpg")
//            ->setMessageUrl("https://www.t12.com")
//            ->send();
    }
}
