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

use App\Model\Db\FaBlockAnalysisdata;
use App\Model\Db\FaBlockCoin;
use Hyperf\DbConnection\Db;

/**
 * Notes: 币种Dao层,封装sql操作
 * Class CoinDao
 * @package App\Model\Dao
 */
class CoinDao
{

    /**币种筛选项
     * @var array
     */
    protected $coinListFiter = [
        'list' => [
            0 => ['price','请输入数值','请输入数值'],
            1 => ['market_cap_usd' , '请输入数值','请输入数值'],
            2 => ['price_div_histHigh' , '请输入0~1之间的数值', '请输入0~1之间的数值'],
            3 => ['change_daily' , '可以带正负号', '可以带正负号'],
        ],
        'data' => [
            0 => ['price','请输入数值','请输入数值'],
            1 => ['market_cap_usd' , '请输入数值','请输入数值'],
            2 => ['price_div_histHigh' , '请输入0~1之间的数值', '请输入0~1之间的数值'],
            3 => ['change_daily' , '可以带正负号', '可以带正负号'],
        ]
    ];

    //默认排序字段
    protected $sort = 'market_cap_usd';

    /**
     * 币种列表
     * @param $data
     * @return mixed
     */
    public function list($data){
        list($where, $sort, $order, $page, $perPage) = $this->buildParams($data);
        $model = FaBlockAnalysisdata::query();
        $list = $model
            ->where($where)
            ->orderBy($sort, $order)
            ->simplePaginate($perPage, ['*'], 'page',$page);
//            ->paginate($perPage, ['*'], 'page',$page);
        return $list;
    }

    /**
     * 处理参数
     * @param $data
     * @return array
     */
    public function buildParams($data){

        $sort = $this->checkSort($data['sort'])?$this->sort:'';
        $order = $data['order']??"DESC";
        $perPage = isset($data['perPage'])? (int) $data['perPage'] : 0;
        $page = isset($data['page'])? (int) $data['page'] : 0;
        $where = [];

        $price_l = $data['filter[0_0]']??'';
        $price_r = $data['filter[0_1]']??'';

        $market_cap_usd_l = $data['filter[1_0]']??'';
        $market_cap_usd_r = $data['filter[1_1]']??'';

        $price_div_histHigh_l = $data['filter[2_0]']??'';
        $price_div_histHigh_r = $data['filter[2_1]']??'';

        $change_daily_l = $data['filter[3_0]']??'';
        $change_daily_r = $data['filter[3_1]']??'';

        $price_l and $where[] = ['price','>',$price_l];
        $price_r and $where[] = ['price','<',$price_r];

        $market_cap_usd_l and $where[] = ['market_cap_usd','>',$market_cap_usd_l*100000000];//转化为单位(亿美元)
        $market_cap_usd_r and $where[] = ['market_cap_usd','<',$market_cap_usd_r*100000000];//转化为单位(亿美元)

        $price_div_histHigh_l and $where[] = ['price_div_histHigh','>',price_div_histHigh_l];
        $price_div_histHigh_r and $where[] = ['price_div_histHigh','<',price_div_histHigh_r];

        $change_daily_l and $where[] = ['change_daily','>',$change_daily_l*1.00 / 100];
        $change_daily_r and $where[] = ['change_daily','<',$change_daily_r*1.00 / 100];

        $where = function($query) use($where){
            foreach ($where as $v){
                if(is_array($v)){
                    call_user_func_array([$query, 'where'], $v);
                }
            }
        };

        return [$where, $sort, $order, $page, $perPage];
    }

    public function checkSort($sort){
        if(!empty($sort)){
            $model = new FaBlockAnalysisdata();
            return $model->isFillable($sort);
        }
        return false;
    }

    /**
     * 获取币种symbol
     */
    public function dictSymbol()
    {
        $result = Db::table('fa_block_coin')
            ->where("isHot",'=','1')
            ->get(["coinId","symbol","fullSymbol","cnSymbol"])
            ->toArray();
        $keyArr = array_column($result, 'symbol');//使用英文简称作为键值
        $data['common'] = array_change_key_case(array_combine($keyArr,$result));//将字母转化为小写
        array_walk($data['common'], function(&$v){
            $v->prefix = 'coin';
        });

        $result = Db::table('fa_block_coin')
            ->where('isHot','=','0')
            ->get(["coinId","symbol","fullSymbol","cnSymbol"])
            ->toArray();
        $keyArr = array_column($result, 'symbol');//使用英文简称作为键值
        $data['coin'] = array_change_key_case(array_combine($keyArr,$result));//将字母转化为小写
        return $data;
    }
}
