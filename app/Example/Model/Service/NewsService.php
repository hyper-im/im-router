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

namespace App\Model\Service;

use App\Exception\ServiceException;
use App\Model\Dao\NewsDao;
use Hyperf\Cache\Annotation\Cacheable;
use Hyperf\Contract\LengthAwarePaginatorInterface as LengthAwarePaginatorInterfaceAlias;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Di\Annotation\Inject;

/**
 * Notes: 快讯服务层,业务逻辑
 * Class NewsService
 * @package App\Model\Service
 */
class NewsService
{

    /**
     * @Inject()
     * @var NewsDao
     */
    protected $newsDao;

    /**
     * 快讯列表
     * @param $data
     * @return LengthAwarePaginatorInterfaceAlias
     */
    public function list($data)
    {
        return $this->newsDao->list($data);
    }

    /**
     * 快讯详情页
     * @param $data
     * @return \Hyperf\Database\Model\Collection|\Hyperf\Database\Model\Model|\Hyperf\Database\Model\Relations\BelongsTo|\Hyperf\Database\Model\Relations\BelongsTo[]|null
     */
    public function detail($data)
    {
        //先判断是否存在
        if(! $this->newsDao->exist($data['id'])){
            throw new ServiceException("当前Id不存在");
        }
        return $this->newsDao->detail($data);
    }

    /**
     * 快讯点赞/取消
     * @param $data
     * @return array
     * @Cacheable(prefix="news", ttl=20, value="_#{data.id}")
     */
    public function action($data)
    {
        return $this->newsDao->action($data);
    }
}
