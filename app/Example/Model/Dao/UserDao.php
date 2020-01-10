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

namespace App\Model\Dao;

use App\Model\Db\FaUser;

/**
 * Class CodeDao,封装sql操作
 * @package App\Model\Dao
 */
class UserDao
{
    /**
     * @param $mobile
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Builder[]|\Hyperf\Database\Model\Collection|\Hyperf\Database\Model\Model|null
     */
    public function getUserByMobile($mobile){
        return FaUser::query()->where("mobile", '=' ,$mobile)->first('id');
    }

    /**
     * 用户注册
     * @param $data
     * @return mixed
     */
    public function create($data){

        $salt = random_salt(6);

        $time = time();
        $password = md5($data['password'].$salt);
        $user = [
            'username' => $data['mobile'],
            'nickname' => substr($data['mobile'],0,4)."****".substr($data['mobile'],-3),
            'password' => $password,
            'salt' => $salt,
            'mobile' => $data['mobile'],
            'joinip' => $data['joinip'],
            'jointime' => $time,
            'createtime' => $time,
            'updatetime' => $time,
            'status' => 'normal',
            'joinplatform' => $data['joinplatform']??1
        ];

        return FaUser::create($user);
    }
}
