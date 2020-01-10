<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-23 下午3:52
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Service;

use App\Model\Dao\CoinDao;
use App\Model\Dao\ExchangeDao;
use Hyperf\Di\Annotation\Inject;

/**
 * Notes: 网站dict词典服务层,业务逻辑
 * Class DictService
 * @package App\Model\Service
 */
class DictService
{

    /**
     * @Inject()
     * @var CoinDao
     */
    protected $coinDao;

    /**
     * @Inject()
     * @var ExchangeDao
     */
    protected $exchangeDao;

    /**
     * 获取symbol
     */
    public function symbols()
    {
        $coinDictSymbol = $this->coinDao->dictSymbol();
        $exchangeDictSymbol = $this->exchangeDao->dictSymbol();

        return [
            'common' => array_merge($coinDictSymbol['common'], $exchangeDictSymbol['common']),
            'coin' => $coinDictSymbol['coin'],
            'exchange' => $exchangeDictSymbol['exchange'],
        ];
    }
}
