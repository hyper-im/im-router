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

namespace App\Model\Service;

use App\Model\Dao\NoticeDao;
use Hyperf\Di\Annotation\Inject;

/**
 * Notes: 公告接口服务层
 * Class NoticeService
 * @package App\Model\Service
 */
class NoticeService
{
    /**
     * @Inject()
     * @var NoticeDao
     */
    protected $noticeDao;

    /**
     * 获取公告列表
     * @param $data
     * @return
     */
    public function list($data){
        return $this->noticeDao->list($data);
    }
}
