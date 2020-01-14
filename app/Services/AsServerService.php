<?php
/**
 * +----------------------------------------------------------------------
 * | im-router 作为服务端需要提供的服务
 * +----------------------------------------------------------------------
 * | Copyright (c) 2020 https://github.com/hyper-im All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2020/1/14 3:28 PM
 * | Author: Quinn (798908243@qq.com) QQ：798908243
 * +----------------------------------------------------------------------
 */

namespace App\Services;

use App\Constants\MessageType;
use App\Constants\RedisKey;
use App\Ws\AsClient;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Hyperf\WebSocketServer\Collector\FdCollector;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;


class AsServerService
{

    /**
     * @Inject()
     * @var AsClient
     */
    private $client;

    /**
     * @Inject()
     * @var AsClientService
     */
    private $clientService;

    public function message(WebSocketServer $server, Frame $frame)
    {
        $data_json = $frame->data;
        $data = im_decode($data_json);
        switch ($data['action'])
        {
            case MessageType::SERVER_REGISTER:
                $params = $data['params'];
                $this->_server_register($params);
                $server->push($frame->fd,json_encode(success(null)));
                break;
            case MessageType::USER_REGISTER:
                //用户注册
                $this->_user_register($data['params']);
                break;
            case MessageType::BROADCAST_ALL:
                $this->_broadcast_to_im_server($data);
                break;
            default:
                return false;
        }
    }

    private function _broadcast_to_im_server($data)
    {
        $this->clientService->broadcast(json_encode($data),$data['ip_port']);
    }

    /**
     * 服务器注册
     * @param $data
     */
    private function _server_register($data)
    {
        $container = ApplicationContext::getContainer();
        $redis = $container->get(\Redis::class);
        $server_info = [
            'serviceName' => $data['serviceName'],
            'ip' => $data['ip'],
            'port' => $data['port'],
        ];
        $key = $data['ip'].":".$data['port'];
        $redis->hSet(RedisKey::IM_SERVER_LIST_KEY,$key,json_encode($server_info));
        $this->client->getInstance($data['ip'],$data['port']);
        var_dump($redis->hGetAll(RedisKey::IM_SERVER_LIST_KEY));

    }

    /**
     * 用户注册
     * @param $data
     */
    private function _user_register($data)
    {

    }
}