<?php
/**
 * +----------------------------------------------------------------------
 * | im-router 作为客户端提供的服务
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/14 3:29 PM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */

namespace App\Services;

use App\Constants\RedisKey;
use App\Ws\AsClient;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;


class AsClientService
{

    /**
     * @Inject()
     * @var AsClient
     */
    private $client;

    public function broadcast($msg,$except_server)
    {
        foreach($this->client as $name => $server)
        {
            if($name != $except_server)
            {
                $server->push($msg);
            }
        }
    }
}