<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-29 下午5:45
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Dao;

use App\Model\Db\FaBlockNotice;

/**
 * Notes: 公告Dao
 * Class NoticeDao
 * @package App\Model\Dao
 */
class NoticeDao
{

    /**
     * 获取公告列表
     * @param $data
     * @return \Hyperf\Contract\LengthAwarePaginatorInterface
     */
    public function list($data){
        list($where, $sort, $order, $page, $perPage) = $this->buildparams($data);
        $model = FaBlockNotice::query();
        $list = $model
            ->where($where)
            ->orderBy($sort, $order)
            ->paginate($perPage, ['*'], 'page',$page);
        return $list;
    }

    /**
     * 处理参数
     * @param $data
     * @return array
     */
    public function buildparams($data){

        $exchangeid = $data['exchangeid']??'';
        $sort = $data['sort']??"newsTime";
        $order = $data['order']??"DESC";
        $perPage = (int) $data['perPage'];
        $page = (int) $data['page'];

        $where[] = ["status", "=", 1];

        //交易所id
        if(!empty($exchangeid))
        {
            $where[] = ["exchangeid", "=", $exchangeid];
        }

        $where = function($query) use($where){
            foreach ($where as $v){
                if(is_array($v)){
                    call_user_func_array([$query, 'where'], $v);
                }
            }
        };
        return [$where, $sort, $order, $page, $perPage];
    }

}
