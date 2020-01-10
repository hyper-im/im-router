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

namespace App\Model\Logic;

use App\Exception\ValidateException;
use App\Model\Validate\CoinValidate;
use Hyperf\Di\Annotation\Inject;

/**
 * 币种逻辑验证层
 * Class CoinLogic
 * @package App\Model\Logic
 */
class CoinLogic
{
    /**
     * @Inject()
     * @var CoinValidate
     */
    protected $coinValidate;

    /**
     * 币种-详情页验证
     * @param $data
     */
    public function detail($data){
        if(! $this->coinValidate->scene('detail')->check($data)){
            throw new ValidateException($this->coinValidate->getError());
        }
    }
}
