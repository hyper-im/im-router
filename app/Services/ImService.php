<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/13 3:40 PM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */

namespace App\Services;

use App\Constants\RedisKey;
use Hyperf\Utils\ApplicationContext;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;


class ImService
{

    public function message(WebSocketServer $server, Frame $frame)
    {
        $data_json = $frame->data;
        $data = json_decode($data_json,true);
        switch ($data['action'])
        {
            case 'register':
                $container = ApplicationContext::getContainer();
                $redis = $container->get(\Redis::class);
                $server_info = [
                    'serviceName' => $data['serviceName'],
                    'ip' => $data['ip'],
                    'port' => $data['port'],
                ];
                $redis->hSet(RedisKey::IM_SERVER_LIST_KEY,$data['serviceName'],json_encode($server_info));
                var_dump($redis->hGetAll(RedisKey::IM_SERVER_LIST_KEY));
                break;
            default:
                return false;
        }
    }

}