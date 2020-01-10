<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-23 下午6:11
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Dao;

use App\Model\Db\FaBlockCoin;
use App\Model\Db\FaCategory;
use Hyperf\DbConnection\Db;

/**
 * Notes: 友情链接,封装sql操作
 * Class CategoryDao
 * @package App\Model\Dao
 */
class CategoryDao
{
    public function get()
    {
        $data = Db::table("fa_category")
            ->where('type','=','friendLink')
            ->where('status','=','normal')
            ->get();
    }

    public function insert(){
        $db = Db::table("fa_category");
        $data = [];
        $db->insert($data);
        $db->where("id",'=','2')->update($data);
        $db->where('id','=', 2)->delete();
        $db->where()->orderBy('id','desc')->offset(10)->limit(10)->select();
        FaCategory::query()->get();

        FaBlockCoin::new();
    }
}
