<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/15 2:44 PM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */

namespace App\Listener;


use App\Constants\RedisKey;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\MainWorkerStart;
use Hyperf\Redis\Redis;
use Psr\Container\ContainerInterface;

/**
 * Class RedisClearListener
 * @package App\Listener
 * @Listener()
 */
class RedisClearListener implements ListenerInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function listen(): array
    {
        return [
            MainWorkerStart::class
        ];
    }


    /**
     * Handle the Event when the event is triggered, all listeners will
     * complete before the event is returned to the EventDispatcher.
     */
    public function process(object $event)
    {
        echo "启动后，首先清空redis缓存...";
        $redis = $this->container->get(Redis::class);
        $redis->del(RedisKey::IM_SERVER_LIST_KEY);
        echo "清除成功".var_dump($redis->hGetAll(RedisKey::IM_SERVER_LIST_KEY));
    }
}