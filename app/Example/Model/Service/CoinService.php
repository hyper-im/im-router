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

namespace App\Model\Service;

use App\Model\Dao\CoinDao;
use Hyperf\Di\Annotation\Inject;

/**
 * 币种是服务层,业务逻辑
 * Class CoinService
 * @package App\Model\Service
 */
class CoinService
{

    /**
     * @Inject()
     * @var CoinDao
     */
    protected $coinDao;

    /**
     * 币种列表
     * @param $data
     * @return mixed
     */
    public function list($data)
    {
        return $this->coinDao->list($data);
    }

    /**
     * 币种详情页
     * @param $data
     */
    public function detail($data){
        //币种coinId是否存在
        $this->coinDao;
    }
}
