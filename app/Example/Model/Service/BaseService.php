<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-24 下午4:32
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Service;


use Hyperf\Di\Annotation\Inject;

/**
 * Notes: 公共操作-,业务逻辑
 * Class BaseService
 * @package App\Model\Service
 */
class BaseService
{
    /**
     * @Inject()
     * @var \Redis
     */
    protected $redis;


    public function symbol($symbol, $symbolType){
        $symbolArr = explode(",", $symbol);

        if($symbolType != ''){
            $symbolType = ucfirst(strtolower($symbolType));
        }

        $result = [];
        if(is_array($symbolArr)){
            if(count($symbolArr) == 1){
                return success($this->parserSymbol($symbolArr[0],$symbolType));
            }else if(count($symbolArr) > 1){

                foreach ($symbolArr as $_symbol){
                    $result[$_symbol] = $this->parserSymbol($_symbol, $symbolType);
                }
            }
        }
        return $result;
    }

    /**
     * 根据symbol返回相关信息
     * @param $symbol
     * @param string $symbolType
     * @return array
     */
    public function parserSymbol($symbol,$symbolType=''){

        $methodPrefix = "getSymbolFrom";
        $typeArr = ['Common','Coin','Exchange'];

        if($symbolType && in_array($symbolType, $typeArr)){
            $method =$methodPrefix.$symbolType;
            return $this->{$method}($symbol);
        }

        foreach ($typeArr as $type){
            $method = $methodPrefix.$type;
            $data = $this->{$method}($symbol);
            if(!empty($data)){
                return $data;
            }
        }
        return [];
    }

    public function getSymbolFromCommon($symbol){
        $cache = $this->redis->hGet("dict_symbol_common",$symbol);
        return $cache? json_decode($cache, true) : [];
    }

    public function getSymbolFromCoin($symbol){
        $cache = $this->redis->hGet("dict_symbol_coin",$symbol);
        return $cache? json_decode($cache,true) : [];
    }

    public function getSymbolFromExchange($symbol){
        $cache = $this->redis->hGet("dict_symbol_exchange",$symbol);
        return $cache? json_decode($cache,true) : [];
    }
}
