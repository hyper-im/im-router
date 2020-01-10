<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-23 下午2:19
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Dao;

use App\Model\Db\FaUserAction;

/**
 * Notes: 用户行为Dao层,封装sql操作
 * Class UserActionDao
 * @package App\Model\Dao
 */
class UserActionDao
{
    /**
     * 判断用户是否已对该文章点赞
     * @param $data
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|object|null
     */
    public function isThumb($data)
    {
        return FaUserAction::query()
            ->where('uid','=', $data['uid'])
            ->where('action_type','=', $data['action_type'])
            ->where('objId', '=', $data['objId'])
            ->first();
    }

    /**
     * 增加用户行为日志
     * @param $data
     */
    public function create($data){
        FaUserAction::query()->insert($data);
    }
}
