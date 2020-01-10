<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2018 https://www.t12.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：19-7-22 上午10:28
 * | Author: Bada (346025425@qq.com) QQ：346025425
 * +----------------------------------------------------------------------
 */

namespace App\Model\Logic;

use App\Exception\ValidateException;
use App\Model\Validate\NewsValidate;
use Hyperf\Di\Annotation\Inject;

/**
 * Notes: 快讯逻辑控制层
 * Class NewsLogic
 * @package App\Model\Logic
 */
class NewsLogic
{
    /**
     * @Inject()
     * @var NewsValidate
     */
    protected $newsValidate;

    /**
     * 快讯列表数据验证
     * @param $data
     */
    public function list($data)
    {
        if(! $this->newsValidate->scene('list')->check($data)){
            throw new ValidateException($this->newsValidate->getError());
        }
    }

    /**
     * 快讯详情页
     * @param $data
     */
    public function detail($data)
    {
        if(! $this->newsValidate->scene('detail')->check($data)){
            throw new ValidateException($this->newsValidate->getError());
        }
    }

    /**
     * 快讯点赞/取消
     * @param $data
     */
    public function action($data){
        if(! $this->newsValidate->scene('action')->check($data)){
            throw new ValidateException($this->newsValidate->getError());
        }
    }
}
