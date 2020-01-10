<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-23 下午3:54
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Dao;


use Hyperf\DbConnection\Db;

/**
 * Notes: 交易所数据交互层,封装sql操作
 * Class ExchangeDao
 * @package App\Model\Dao
 */
class ExchangeDao
{
    /**
     * 获取交易所symbol
     */
    public function dictSymbol()
    {
        $result = Db::table('fa_block_exchange')
            ->where("isHot",'=','1')
            ->get(["id","symbol","fullSymbol","cnSymbol"])
            ->toArray();
        $keyArr = array_column($result, 'symbol');//使用英文简称作为键值
        $data['common'] = array_change_key_case(array_combine($keyArr,$result));//将字母转化为小写
        array_walk($data['common'], function(&$v){
            $v->prefix = 'exchange';
        });

        $result = Db::table('fa_block_exchange')
            ->where('isHot','=','0')
            ->get(["id","symbol","fullSymbol","cnSymbol"])
            ->toArray();
        $keyArr = array_column($result, 'symbol');//使用英文简称作为键值
        $data['exchange'] = array_change_key_case(array_combine($keyArr,$result));//将字母转化为小写
        return $data;
    }
}
